import React, { useState } from 'react';
import { useNavigate } from 'react-router-dom';
import { useAuth } from '../contexts/AuthContext';
import { mockPosts } from '../mock/posts';

export default function Profile() {
  const { user } = useAuth();
  const navigate = useNavigate();
  const [activeTab, setActiveTab] = useState('posts');
  const [showDeleteModal, setShowDeleteModal] = useState(false);
  const [postToDelete, setPostToDelete] = useState(null);

  // Pour le moment, on filtre les posts mockés pour simuler les posts de l'utilisateur
  const userPosts = mockPosts.filter(post => post.user.id === user?.id);

  const handleDeleteClick = (post) => {
    setPostToDelete(post);
    setShowDeleteModal(true);
  };

  const handleConfirmDelete = () => {
    // Ici, on implémentera la suppression réelle
    console.log('Suppression du post:', postToDelete.id);
    setShowDeleteModal(false);
    setPostToDelete(null);
  };

  if (!user) {
    navigate('/login');
    return null;
  }

  return (
    <div className="container mx-auto px-4 py-8">
      <div className="max-w-5xl mx-auto">
        {/* En-tête du profil */}
        <div className="bg-white rounded-lg shadow-lg p-6 mb-6">
          <div className="flex items-center">
            <img
              src={user.avatar || 'https://via.placeholder.com/100'}
              alt={user.name}
              className="w-24 h-24 rounded-full object-cover"
            />
            <div className="ml-6">
              <h1 className="text-2xl font-bold text-gray-900">{user.name}</h1>
              <p className="text-gray-600">{user.email}</p>
              <div className="mt-2 flex space-x-4">
                <span className="text-sm text-gray-500">
                  Membre depuis {new Date(user.created_at || Date.now()).toLocaleDateString()}
                </span>
                <span className="text-sm text-gray-500">
                  {userPosts.length} publication{userPosts.length !== 1 ? 's' : ''}
                </span>
              </div>
            </div>
          </div>
        </div>

        {/* Onglets */}
        <div className="bg-white rounded-lg shadow-lg overflow-hidden">
          <div className="border-b border-gray-200">
            <nav className="flex">
              <button
                onClick={() => setActiveTab('posts')}
                className={`px-6 py-4 text-sm font-medium ${
                  activeTab === 'posts'
                    ? 'border-b-2 border-blue-500 text-blue-600'
                    : 'text-gray-500 hover:text-gray-700'
                }`}
              >
                Mes publications
              </button>
              <button
                onClick={() => setActiveTab('settings')}
                className={`px-6 py-4 text-sm font-medium ${
                  activeTab === 'settings'
                    ? 'border-b-2 border-blue-500 text-blue-600'
                    : 'text-gray-500 hover:text-gray-700'
                }`}
              >
                Paramètres
              </button>
            </nav>
          </div>

          {/* Contenu des onglets */}
          <div className="p-6">
            {activeTab === 'posts' ? (
              <div className="space-y-6">
                {userPosts.length > 0 ? (
                  userPosts.map(post => (
                    <div key={post.id} className="bg-white border rounded-lg overflow-hidden">
                      <div className="flex">
                        <div className="w-48 h-48">
                          <img
                            src={post.image_url}
                            alt={post.title}
                            className="w-full h-full object-cover"
                          />
                        </div>
                        <div className="flex-1 p-4">
                          <div className="flex justify-between items-start">
                            <div>
                              <h3 className="text-lg font-semibold text-gray-900">
                                {post.title}
                              </h3>
                              <p className="mt-1 text-sm text-gray-500">
                                Publié le {new Date(post.created_at).toLocaleDateString()}
                              </p>
                              <p className="mt-2 text-gray-600 line-clamp-2">
                                {post.description}
                              </p>
                            </div>
                            <span
                              className={`px-3 py-1 rounded-full text-sm font-medium ${
                                post.type === 'lost'
                                  ? 'bg-red-100 text-red-800'
                                  : 'bg-green-100 text-green-800'
                              }`}
                            >
                              {post.type === 'lost' ? 'Perdu' : 'Trouvé'}
                            </span>
                          </div>
                          <div className="mt-4 flex justify-between items-center">
                            <div className="flex space-x-4 text-sm text-gray-500">
                              <span>{post.views_count} vues</span>
                              {post.has_reward && (
                                <span className="text-green-600">
                                  Récompense: {post.reward_amount}€
                                </span>
                              )}
                            </div>
                            <div className="flex space-x-2">
                              <button
                                onClick={() => navigate(`/posts/${post.id}/edit`)}
                                className="px-3 py-1 text-sm text-blue-600 hover:text-blue-800"
                              >
                                Modifier
                              </button>
                              <button
                                onClick={() => handleDeleteClick(post)}
                                className="px-3 py-1 text-sm text-red-600 hover:text-red-800"
                              >
                                Supprimer
                              </button>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                  ))
                ) : (
                  <div className="text-center py-12">
                    <h3 className="text-lg font-medium text-gray-900">
                      Vous n'avez pas encore de publications
                    </h3>
                    <p className="mt-2 text-gray-600">
                      Commencez par publier un objet perdu ou trouvé
                    </p>
                    <button
                      onClick={() => navigate('/posts/new')}
                      className="mt-4 px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700"
                    >
                      Créer une publication
                    </button>
                  </div>
                )}
              </div>
            ) : (
              <div className="space-y-6">
                <h3 className="text-lg font-medium text-gray-900">Paramètres du compte</h3>
                {/* Formulaire des paramètres à implémenter */}
                <p className="text-gray-600">
                  Les paramètres du compte seront disponibles prochainement.
                </p>
              </div>
            )}
          </div>
        </div>
      </div>

      {/* Modal de confirmation de suppression */}
      {showDeleteModal && (
        <div className="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center p-4">
          <div className="bg-white rounded-lg max-w-md w-full p-6">
            <h3 className="text-lg font-medium text-gray-900 mb-4">
              Confirmer la suppression
            </h3>
            <p className="text-gray-600 mb-6">
              Êtes-vous sûr de vouloir supprimer cette publication ? Cette action est irréversible.
            </p>
            <div className="flex justify-end space-x-4">
              <button
                onClick={() => setShowDeleteModal(false)}
                className="px-4 py-2 text-gray-600 hover:text-gray-800"
              >
                Annuler
              </button>
              <button
                onClick={handleConfirmDelete}
                className="px-4 py-2 bg-red-600 text-white rounded-lg hover:bg-red-700"
              >
                Supprimer
              </button>
            </div>
          </div>
        </div>
      )}
    </div>
  );
}
