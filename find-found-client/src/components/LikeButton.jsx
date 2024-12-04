import React from 'react';
import { useQuery, useMutation, useQueryClient } from '@tanstack/react-query';
import { useAuth } from '../contexts/AuthContext';
import { likeService } from '../services/likeService';

export default function LikeButton({ postId }) {
  const { user } = useAuth();
  const queryClient = useQueryClient();

  const { data: likeInfo, isLoading } = useQuery({
    queryKey: ['likes', postId],
    queryFn: () => likeService.getLikeCount(postId),
    enabled: !!postId
  });

  const likeMutation = useMutation({
    mutationFn: () => likeService.toggleLike(postId),
    onSuccess: () => {
      queryClient.invalidateQueries(['likes', postId]);
    }
  });

  const handleLikeClick = () => {
    if (!user) {
      // Rediriger vers la page de connexion ou afficher une modal
      alert('Veuillez vous connecter pour aimer ce post');
      return;
    }
    likeMutation.mutate();
  };

  if (isLoading) {
    return (
      <div className="animate-pulse flex items-center space-x-2">
        <div className="w-6 h-6 bg-gray-200 rounded-full"></div>
        <div className="w-8 h-4 bg-gray-200 rounded"></div>
      </div>
    );
  }

  return (
    <button
      onClick={handleLikeClick}
      disabled={likeMutation.isPending}
      className={`flex items-center space-x-2 px-4 py-2 rounded-lg transition-colors ${
        likeInfo?.user_has_liked
          ? 'text-red-600 hover:text-red-700'
          : 'text-gray-600 hover:text-gray-700'
      }`}
    >
      <svg
        xmlns="http://www.w3.org/2000/svg"
        className={`h-6 w-6 ${
          likeMutation.isPending ? 'animate-pulse' : ''
        }`}
        fill={likeInfo?.user_has_liked ? 'currentColor' : 'none'}
        viewBox="0 0 24 24"
        stroke="currentColor"
      >
        <path
          strokeLinecap="round"
          strokeLinejoin="round"
          strokeWidth={2}
          d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"
        />
      </svg>
      <span className="font-medium">
        {likeInfo?.likes_count || 0}
      </span>
    </button>
  );
}
