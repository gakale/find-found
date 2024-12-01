import React from 'react';
import { Link } from 'react-router-dom';

export default function PostCard({ post }) {
  return (
    <div className="bg-white rounded-lg shadow-md overflow-hidden hover:shadow-lg transition-shadow">
      <Link to={`/posts/${post.id}`} className="block">
        <div className="relative">
          <img 
            src={post.image_url} 
            alt={post.title}
            className="w-full h-48 object-cover"
          />
          <div className="absolute top-4 right-4">
            <span className={`
              px-3 py-1 rounded-full text-sm font-medium
              ${post.type === 'lost' 
                ? 'bg-red-100 text-red-800' 
                : 'bg-green-100 text-green-800'
              }
            `}>
              {post.type === 'lost' ? 'Perdu' : 'Trouvé'}
            </span>
          </div>
        </div>
      </Link>
      
      <div className="p-4">
        <Link to={`/posts/${post.id}`} className="block">
          <div className="flex items-center mb-3">
            <img 
              src={post.user.avatar} 
              alt={post.user.name}
              className="w-8 h-8 rounded-full mr-2"
            />
            <span className="text-gray-600 text-sm">{post.user.name}</span>
          </div>

          <h3 className="text-lg font-semibold mb-2 text-gray-900 hover:text-blue-600 transition-colors">
            {post.title}
          </h3>
          <p className="text-gray-600 text-sm mb-3 line-clamp-2">{post.description}</p>
        </Link>
        
        <div className="flex items-center text-sm text-gray-500 mb-3">
          <svg className="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path strokeLinecap="round" strokeLinejoin="round" strokeWidth="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
            <path strokeLinecap="round" strokeLinejoin="round" strokeWidth="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
          </svg>
          {post.location}
        </div>

        <div className="flex justify-between items-center">
          <div className="flex items-center text-sm text-gray-500">
            <svg className="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path strokeLinecap="round" strokeLinejoin="round" strokeWidth="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
            </svg>
            {new Date(post.created_at).toLocaleDateString()}
          </div>
          {post.has_reward && (
            <div className="text-green-600 font-medium text-sm">
              Récompense: {post.reward_amount}€
            </div>
          )}
        </div>
      </div>

      <div className="px-4 py-3 bg-gray-50 border-t">
        <Link 
          to={`/posts/${post.id}`}
          className="block w-full text-center py-2 px-4 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition-colors"
        >
          Voir les détails
        </Link>
      </div>
    </div>
  );
}
