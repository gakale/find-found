import React, { useState } from 'react';
import { useQuery, useMutation, useQueryClient } from '@tanstack/react-query';
import { useAuth } from '../contexts/AuthContext';
import { commentService } from '../services/commentService';

export default function Comments({ postId }) {
  const { user } = useAuth();
  const [newComment, setNewComment] = useState('');
  const [editingComment, setEditingComment] = useState(null);
  const queryClient = useQueryClient();

  const { data: comments, isLoading } = useQuery({
    queryKey: ['comments', postId],
    queryFn: () => commentService.getComments(postId)
  });

  const createMutation = useMutation({
    mutationFn: (content) => commentService.createComment(postId, content),
    onSuccess: () => {
      queryClient.invalidateQueries(['comments', postId]);
      setNewComment('');
    }
  });

  const updateMutation = useMutation({
    mutationFn: ({ commentId, content }) => commentService.updateComment(commentId, content),
    onSuccess: () => {
      queryClient.invalidateQueries(['comments', postId]);
      setEditingComment(null);
    }
  });

  const deleteMutation = useMutation({
    mutationFn: (commentId) => commentService.deleteComment(commentId),
    onSuccess: () => {
      queryClient.invalidateQueries(['comments', postId]);
    }
  });

  const handleSubmit = (e) => {
    e.preventDefault();
    if (!newComment.trim()) return;
    createMutation.mutate(newComment);
  };

  const handleUpdate = (commentId, content) => {
    updateMutation.mutate({ commentId, content });
  };

  const handleDelete = (commentId) => {
    if (window.confirm('Êtes-vous sûr de vouloir supprimer ce commentaire ?')) {
      deleteMutation.mutate(commentId);
    }
  };

  if (isLoading) {
    return <div className="animate-pulse">Chargement des commentaires...</div>;
  }

  return (
    <div className="space-y-6">
      <h3 className="text-lg font-semibold">Commentaires</h3>

      {/* Formulaire de nouveau commentaire */}
      {user && (
        <form onSubmit={handleSubmit} className="space-y-4">
          <textarea
            value={newComment}
            onChange={(e) => setNewComment(e.target.value)}
            placeholder="Ajouter un commentaire..."
            className="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent"
            rows="3"
          />
          <button
            type="submit"
            disabled={createMutation.isPending}
            className="px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 disabled:opacity-50"
          >
            {createMutation.isPending ? 'Envoi...' : 'Commenter'}
          </button>
        </form>
      )}

      {/* Liste des commentaires */}
      <div className="space-y-4">
        {comments?.comments.map((comment) => (
          <div key={comment.id} className="bg-white p-4 rounded-lg shadow">
            {editingComment === comment.id ? (
              <div className="space-y-2">
                <textarea
                  defaultValue={comment.content}
                  className="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                  rows="3"
                  ref={(textarea) => {
                    if (textarea) {
                      textarea.focus();
                      textarea.setSelectionRange(textarea.value.length, textarea.value.length);
                    }
                  }}
                />
                <div className="flex space-x-2">
                  <button
                    onClick={() => handleUpdate(comment.id, textarea.value)}
                    className="px-3 py-1 bg-blue-600 text-white rounded hover:bg-blue-700"
                  >
                    Enregistrer
                  </button>
                  <button
                    onClick={() => setEditingComment(null)}
                    className="px-3 py-1 bg-gray-200 text-gray-700 rounded hover:bg-gray-300"
                  >
                    Annuler
                  </button>
                </div>
              </div>
            ) : (
              <>
                <div className="flex justify-between items-start">
                  <div>
                    <p className="font-medium text-gray-900">{comment.user.name}</p>
                    <p className="text-sm text-gray-500">
                      {new Date(comment.created_at).toLocaleDateString()}
                    </p>
                  </div>
                  {user?.id === comment.user_id && (
                    <div className="flex space-x-2">
                      <button
                        onClick={() => setEditingComment(comment.id)}
                        className="text-blue-600 hover:text-blue-800"
                      >
                        Modifier
                      </button>
                      <button
                        onClick={() => handleDelete(comment.id)}
                        className="text-red-600 hover:text-red-800"
                      >
                        Supprimer
                      </button>
                    </div>
                  )}
                </div>
                <p className="mt-2 text-gray-700">{comment.content}</p>
              </>
            )}
          </div>
        ))}
      </div>
    </div>
  );
}
