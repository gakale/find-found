import React, { useState, useMemo, useEffect } from 'react';
import { mockPosts } from '../mock/posts';
import PostCard from './PostCard';

const ITEMS_PER_PAGE = 10;
const CATEGORIES = ['Tous', 'Électronique', 'Accessoires', 'Clés', 'Bijoux', 'Jouets'];

export default function PostsList({ defaultType = 'all' }) {
  const [currentPage, setCurrentPage] = useState(1);
  const [filters, setFilters] = useState({
    type: defaultType,
    category: 'Tous',
    searchQuery: '',
  });

  // Mettre à jour le filtre de type lorsque defaultType change
  useEffect(() => {
    setFilters(prev => ({
      ...prev,
      type: defaultType
    }));
  }, [defaultType]);

  // Filtrer les posts
  const filteredPosts = useMemo(() => {
    return mockPosts.filter(post => {
      const matchesType = filters.type === 'all' || post.type === filters.type;
      const matchesCategory = filters.category === 'Tous' || post.category === filters.category;
      const matchesSearch = filters.searchQuery === '' || 
        post.title.toLowerCase().includes(filters.searchQuery.toLowerCase()) ||
        post.description.toLowerCase().includes(filters.searchQuery.toLowerCase());
      
      return matchesType && matchesCategory && matchesSearch;
    });
  }, [filters]);

  // Pagination
  const totalPages = Math.ceil(filteredPosts.length / ITEMS_PER_PAGE);
  const paginatedPosts = filteredPosts.slice(
    (currentPage - 1) * ITEMS_PER_PAGE,
    currentPage * ITEMS_PER_PAGE
  );

  const handleFilterChange = (e) => {
    const { name, value } = e.target;
    setFilters(prev => ({
      ...prev,
      [name]: value
    }));
    setCurrentPage(1);
  };

  return (
    <div className="container mx-auto px-4 py-8">
      {/* En-tête */}
      <div className="mb-8">
        <h1 className="text-3xl font-bold text-gray-900">
          {filters.type === 'lost' ? 'Objets perdus' : 
           filters.type === 'found' ? 'Objets trouvés' : 
           'Tous les objets'}
        </h1>
        <p className="mt-2 text-gray-600">
          {filters.type === 'lost' ? 'Retrouvez les objets que les gens ont perdus' : 
           filters.type === 'found' ? 'Découvrez les objets qui ont été trouvés' : 
           'Parcourez tous les objets perdus et trouvés'}
        </p>
      </div>

      {/* Filtres */}
      <div className="mb-8 space-y-4">
        <div className="grid grid-cols-1 md:grid-cols-3 gap-4">
          <div className="relative">
            <input
              type="text"
              name="searchQuery"
              placeholder="Rechercher un objet..."
              className="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
              value={filters.searchQuery}
              onChange={handleFilterChange}
            />
            <svg 
              className="absolute right-3 top-2.5 h-5 w-5 text-gray-400"
              fill="none" 
              stroke="currentColor" 
              viewBox="0 0 24 24"
            >
              <path strokeLinecap="round" strokeLinejoin="round" strokeWidth="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
            </svg>
          </div>

          <select
            name="type"
            className="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
            value={filters.type}
            onChange={handleFilterChange}
          >
            <option value="all">Tous les types</option>
            <option value="lost">Objets perdus</option>
            <option value="found">Objets trouvés</option>
          </select>

          <select
            name="category"
            className="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
            value={filters.category}
            onChange={handleFilterChange}
          >
            {CATEGORIES.map(category => (
              <option key={category} value={category}>
                {category}
              </option>
            ))}
          </select>
        </div>
      </div>

      {/* Liste des posts */}
      {paginatedPosts.length > 0 ? (
        <div className="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
          {paginatedPosts.map(post => (
            <PostCard key={post.id} post={post} />
          ))}
        </div>
      ) : (
        <div className="text-center py-12">
          <h3 className="text-xl font-medium text-gray-900">Aucun résultat trouvé</h3>
          <p className="mt-2 text-gray-600">Essayez de modifier vos filtres de recherche</p>
        </div>
      )}

      {/* Pagination */}
      {paginatedPosts.length > 0 && (
        <div className="mt-8 flex justify-center space-x-2">
          <button
            onClick={() => setCurrentPage(prev => Math.max(prev - 1, 1))}
            disabled={currentPage === 1}
            className="px-4 py-2 border rounded-lg disabled:opacity-50 hover:bg-gray-50"
          >
            Précédent
          </button>
          <div className="flex items-center px-4">
            Page {currentPage} sur {totalPages}
          </div>
          <button
            onClick={() => setCurrentPage(prev => Math.min(prev + 1, totalPages))}
            disabled={currentPage === totalPages}
            className="px-4 py-2 border rounded-lg disabled:opacity-50 hover:bg-gray-50"
          >
            Suivant
          </button>
        </div>
      )}
    </div>
  );
}
