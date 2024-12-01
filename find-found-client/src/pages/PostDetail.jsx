import React, { useState } from 'react';
import { useParams, Link } from 'react-router-dom';
import { useAuth } from '../contexts/AuthContext';
import { mockPosts } from '../mock/posts';

export default function PostDetail() {
  const { id } = useParams();
  const { user } = useAuth();
  const [showContact, setShowContact] = useState(false);
  
  // Pour le moment, on utilise les données mockées
  const post = mockPosts.find(p => p.id === parseInt(id));

  if (!post) {
    return (
      <div className="container mx-auto px-4 py-8">
        <div className="text-center">
          <h2 className="text-2xl font-bold text-gray-900">Annonce non trouvée</h2>
          <p className="mt-2 text-gray-600">L'annonce que vous recherchez n'existe pas ou a été supprimée.</p>
          <Link to="/" className="mt-4 inline-block text-blue-600 hover:text-blue-800">
            Retourner à l'accueil
          </Link>
        </div>
      </div>
    );
  }

  const formattedDate = new Date(post.created_at).toLocaleDateString('fr-FR', {
    year: 'numeric',
    month: 'long',
    day: 'numeric',
    hour: '2-digit',
    minute: '2-digit'
  });

  return (
    <div className="container mx-auto px-4 py-8">
      <div className="max-w-4xl mx-auto">
        {/* Fil d'Ariane */}
        <nav className="flex mb-8 text-gray-500 text-sm">
          <Link to="/" className="hover:text-gray-900">Accueil</Link>
          <span className="mx-2">/</span>
          <Link 
            to={post.type === 'lost' ? '/lost' : '/found'} 
            className="hover:text-gray-900"
          >
            {post.type === 'lost' ? 'Objets perdus' : 'Objets trouvés'}
          </Link>
          <span className="mx-2">/</span>
          <span className="text-gray-900">{post.title}</span>
        </nav>

        {/* Image et Informations principales */}
        <div className="bg-white rounded-lg shadow-lg overflow-hidden">
          <div className="relative">
            <img 
              src={post.image_url} 
              alt={post.title}
              className="w-full h-[400px] object-cover"
            />
            <div className="absolute top-4 right-4">
              <span className={`
                px-4 py-2 rounded-full text-sm font-medium
                ${post.type === 'lost' 
                  ? 'bg-red-100 text-red-800' 
                  : 'bg-green-100 text-green-800'
                }
              `}>
                {post.type === 'lost' ? 'Perdu' : 'Trouvé'}
              </span>
            </div>
          </div>

          <div className="p-6">
            <div className="flex items-center mb-4">
              <img 
                src={post.user.avatar} 
                alt={post.user.name}
                className="w-10 h-10 rounded-full mr-3"
              />
              <div>
                <div className="font-medium">{post.user.name}</div>
                <div className="text-sm text-gray-500">{formattedDate}</div>
              </div>
            </div>

            <h1 className="text-3xl font-bold text-gray-900 mb-4">{post.title}</h1>
            
            <div className="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
              <div>
                <h2 className="text-lg font-semibold mb-3">Détails</h2>
                <ul className="space-y-2">
                  <li className="flex items-center text-gray-600">
                    <svg className="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                      <path strokeLinecap="round" strokeLinejoin="round" strokeWidth="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                      <path strokeLinecap="round" strokeLinejoin="round" strokeWidth="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                    </svg>
                    {post.location}
                  </li>
                  <li className="flex items-center text-gray-600">
                    <svg className="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                      <path strokeLinecap="round" strokeLinejoin="round" strokeWidth="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z" />
                    </svg>
                    Catégorie: {post.category}
                  </li>
                  {post.has_reward && (
                    <li className="flex items-center text-green-600 font-medium">
                      <svg className="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path strokeLinecap="round" strokeLinejoin="round" strokeWidth="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                      </svg>
                      Récompense: {post.reward_amount}€
                    </li>
                  )}
                </ul>
              </div>

              <div>
                <h2 className="text-lg font-semibold mb-3">Statistiques</h2>
                <ul className="space-y-2">
                  <li className="flex items-center text-gray-600">
                    <svg className="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                      <path strokeLinecap="round" strokeLinejoin="round" strokeWidth="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                      <path strokeLinecap="round" strokeLinejoin="round" strokeWidth="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                    </svg>
                    {post.views_count} vues
                  </li>
                </ul>
              </div>
            </div>

            <div className="border-t border-gray-200 pt-6">
              <h2 className="text-lg font-semibold mb-3">Description</h2>
              <p className="text-gray-600 whitespace-pre-line">{post.description}</p>
            </div>

            {/* Boutons d'action */}
            <div className="mt-8 flex flex-col sm:flex-row gap-4">
              {!showContact ? (
                <button
                  onClick={() => setShowContact(true)}
                  className="flex-1 bg-blue-600 text-white px-6 py-3 rounded-lg hover:bg-blue-700 transition-colors flex items-center justify-center"
                >
                  <svg className="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path strokeLinecap="round" strokeLinejoin="round" strokeWidth="2" d="M16 12a4 4 0 10-8 0 4 4 0 008 0zm0 0v1.5a2.5 2.5 0 005 0V12a9 9 0 10-9 9m4.5-1.206a8.959 8.959 0 01-4.5 1.207" />
                  </svg>
                  Voir les coordonnées
                </button>
              ) : (
                <div className="flex-1 bg-gray-50 p-4 rounded-lg">
                  <h3 className="font-medium mb-2">Coordonnées de contact</h3>
                  <ul className="space-y-2">
                    {post.contact_phone && (
                      <li className="flex items-center">
                        <svg className="w-5 h-5 mr-2 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                          <path strokeLinecap="round" strokeLinejoin="round" strokeWidth="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z" />
                        </svg>
                        <a href={`tel:${post.contact_phone}`} className="text-blue-600 hover:text-blue-800">
                          {post.contact_phone}
                        </a>
                      </li>
                    )}
                    {post.contact_email && (
                      <li className="flex items-center">
                        <svg className="w-5 h-5 mr-2 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                          <path strokeLinecap="round" strokeLinejoin="round" strokeWidth="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                        </svg>
                        <a href={`mailto:${post.contact_email}`} className="text-blue-600 hover:text-blue-800">
                          {post.contact_email}
                        </a>
                      </li>
                    )}
                  </ul>
                </div>
              )}
              
              <button
                className="flex-1 border border-gray-300 text-gray-700 px-6 py-3 rounded-lg hover:bg-gray-50 transition-colors flex items-center justify-center"
              >
                <svg className="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                  <path strokeLinecap="round" strokeLinejoin="round" strokeWidth="2" d="M8.684 13.342C8.886 12.938 9 12.482 9 12c0-.482-.114-.938-.316-1.342m0 2.684a3 3 0 110-2.684m0 2.684l6.632 3.316m-6.632-6l6.632-3.316m0 0a3 3 0 105.367-2.684 3 3 0 00-5.367 2.684zm0 9.316a3 3 0 105.368 2.684 3 3 0 00-5.368-2.684z" />
                </svg>
                Partager
              </button>
            </div>
          </div>
        </div>
      </div>
    </div>
  );
}
