import React, { useState } from 'react';
import { useQuery } from '@tanstack/react-query';
import { Link } from 'react-router-dom';
import { postService } from '../services/api';

export default function PostsList({ defaultType = null }) {
  const [type, setType] = useState(defaultType);
  const [search, setSearch] = useState('');
  const [currentPage, setCurrentPage] = useState(1);

  const { data: posts, isLoading, error } = useQuery({
    queryKey: ['posts', type, search, currentPage],
    queryFn: () => postService.getPosts({ type, search, page: currentPage }),
    keepPreviousData: true
  });

  const handleSearchChange = (e) => {
    setSearch(e.target.value);
  };

  const handleTypeChange = (newType) => {
    setType(newType);
  };

  if (isLoading) {
    return (
      <div className="flex justify-center items-center min-h-screen">
        <div className="animate-spin rounded-full h-12 w-12 border-t-2 border-b-2 border-blue-500"></div>
      </div>
    );
  }

  if (error) {
    return (
      <div className="text-center py-12">
        <p className="text-red-500">Une erreur est survenue lors du chargement des posts.</p>
      </div>
    );
  }

  return (
    <div className="container mx-auto px-4 py-8">
      <div className="mb-8">
        <div className="flex flex-col sm:flex-row justify-between items-center gap-4">
          <div className="flex space-x-4">
            <button
              onClick={() => handleTypeChange(null)}
              className={`px-4 py-2 rounded-lg ${
                type === null
                  ? 'bg-blue-600 text-white'
                  : 'bg-gray-100 text-gray-700 hover:bg-gray-200'
              }`}
            >
              Tous
            </button>
            <button
              onClick={() => handleTypeChange('lost')}
              className={`px-4 py-2 rounded-lg ${
                type === 'lost'
                  ? 'bg-red-600 text-white'
                  : 'bg-gray-100 text-gray-700 hover:bg-gray-200'
              }`}
            >
              Objets perdus
            </button>
            <button
              onClick={() => handleTypeChange('found')}
              className={`px-4 py-2 rounded-lg ${
                type === 'found'
                  ? 'bg-green-600 text-white'
                  : 'bg-gray-100 text-gray-700 hover:bg-gray-200'
              }`}
            >
              Objets trouvés
            </button>
          </div>
          <div className="w-full sm:w-auto">
            <input
              type="text"
              placeholder="Rechercher..."
              value={search}
              onChange={handleSearchChange}
              className="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent"
            />
          </div>
        </div>
      </div>

      {posts?.data.length > 0 ? (
        <div className="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
          {posts.data.map((post) => (
            <Link
              key={post.id}
              to={`/posts/${post.id}`}
              className="block bg-white rounded-lg shadow-lg overflow-hidden hover:shadow-xl transition-shadow duration-300"
            >
              <div className="relative">
                <img
                  src={post.image_url || 'https://via.placeholder.com/400x300'}
                  alt={post.title}
                  className="w-full h-48 object-cover"
                />
                <span
                  className={`absolute top-4 right-4 px-3 py-1 rounded-full text-sm font-medium ${
                    post.type === 'lost'
                      ? 'bg-red-100 text-red-800'
                      : 'bg-green-100 text-green-800'
                  }`}
                >
                  {post.type === 'lost' ? 'Perdu' : 'Trouvé'}
                </span>
              </div>
              <div className="p-4">
                <h3 className="text-lg font-semibold text-gray-900 mb-2">
                  {post.title}
                </h3>
                <p className="text-gray-600 text-sm mb-4 line-clamp-2">
                  {post.description}
                </p>
                <div className="flex justify-between items-center text-sm text-gray-500">
                  <span>{new Date(post.date).toLocaleDateString()}</span>
                  <span>{post.location}</span>
                </div>
                {post.reward_amount > 0 && (
                  <div className="mt-2 text-green-600 font-medium">
                    Récompense : {post.reward_amount}€
                  </div>
                )}
              </div>
            </Link>
          ))}
        </div>
      ) : (
        <div className="text-center py-12">
          <h3 className="text-lg font-medium text-gray-900">
            Aucun post trouvé
          </h3>
          <p className="mt-2 text-gray-600">
            Essayez de modifier vos critères de recherche
          </p>
        </div>
      )}

      {posts?.meta?.links && (
        <div className="mt-8 flex justify-center">
          <nav className="relative z-0 inline-flex rounded-md shadow-sm -space-x-px">
            {posts.meta.links.map((link, index) => (
              <button
                key={index}
                onClick={() => {
                  if (link.url) {
                    // Extraire le numéro de page de l'URL et mettre à jour
                    const page = new URL(link.url).searchParams.get('page');
                    setCurrentPage(parseInt(page));
                  }
                }}
                disabled={!link.url}
                className={`relative inline-flex items-center px-4 py-2 border text-sm font-medium ${
                  link.active
                    ? 'z-10 bg-blue-50 border-blue-500 text-blue-600'
                    : 'bg-white border-gray-300 text-gray-500 hover:bg-gray-50'
                } ${!link.url && 'cursor-not-allowed opacity-50'}`}
              >
                <span dangerouslySetInnerHTML={{ __html: link.label }} />
              </button>
            ))}
          </nav>
        </div>
      )}
    </div>
  );
}
