export const mockPosts = [
  {
    id: 1,
    title: "iPhone 13 Pro perdu",
    description: "J'ai perdu mon iPhone 13 Pro bleu au parc des Buttes-Chaumont hier soir vers 18h. Il a une coque transparente et l'écran est légèrement fissuré en haut à droite.",
    type: "lost",
    category: "Électronique",
    location: "Parc des Buttes-Chaumont, Paris",
    contact_phone: "0612345678",
    contact_email: "user1@example.com",
    has_reward: true,
    reward_amount: 100,
    status: "active",
    views_count: 45,
    created_at: "2024-01-15T14:30:00Z",
    image_url: "https://images.unsplash.com/photo-1592899677977-9c10ca588bbd?w=500",
    user: {
      id: 1,
      name: "Jean Dupont",
      avatar: "https://randomuser.me/api/portraits/men/1.jpg"
    }
  },
  {
    id: 2,
    title: "Trouvé - Portefeuille marron",
    description: "J'ai trouvé un portefeuille marron de marque Louis Vuitton contenant des cartes bancaires près de la station de métro. Je l'ai déposé au guichet de la station.",
    type: "found",
    category: "Accessoires",
    location: "Station Châtelet, Paris",
    contact_phone: "0623456789",
    contact_email: "user2@example.com",
    has_reward: false,
    status: "active",
    views_count: 32,
    created_at: "2024-01-14T10:15:00Z",
    image_url: "https://images.unsplash.com/photo-1627123424574-724758594e93?w=500",
    user: {
      id: 2,
      name: "Marie Martin",
      avatar: "https://randomuser.me/api/portraits/women/1.jpg"
    }
  },
  {
    id: 3,
    title: "Clés de voiture perdues",
    description: "Perdu mes clés de Renault avec un porte-clés rouge dans le quartier du Marais. Il y a aussi un badge d'accès d'immeuble attaché.",
    type: "lost",
    category: "Clés",
    location: "Le Marais, Paris",
    contact_phone: "0634567890",
    has_reward: true,
    reward_amount: 50,
    status: "active",
    views_count: 28,
    created_at: "2024-01-13T16:45:00Z",
    image_url: "https://images.unsplash.com/photo-1581795669633-91ef7c9699a8?w=500",
    user: {
      id: 3,
      name: "Pierre Durand",
      avatar: "https://randomuser.me/api/portraits/men/2.jpg"
    }
  },
  {
    id: 4,
    title: "Trouvé - Appareil photo Canon",
    description: "Trouvé un appareil photo Canon EOS 80D avec objectif 18-135mm sur un banc. Contient des photos de vacances, j'aimerais le rendre à son propriétaire.",
    type: "found",
    category: "Électronique",
    location: "Jardin des Tuileries, Paris",
    contact_phone: "0645678901",
    status: "active",
    views_count: 56,
    created_at: "2024-01-12T09:20:00Z",
    image_url: "https://images.unsplash.com/photo-1516035069371-29a1b244cc32?w=500",
    user: {
      id: 4,
      name: "Sophie Bernard",
      avatar: "https://randomuser.me/api/portraits/women/2.jpg"
    }
  },
  {
    id: 5,
    title: "Perdu - Bracelet en or",
    description: "J'ai perdu mon bracelet en or avec des pierres bleues. C'est un bijou de famille avec une grande valeur sentimentale.",
    type: "lost",
    category: "Bijoux",
    location: "Champs-Élysées, Paris",
    contact_phone: "0656789012",
    has_reward: true,
    reward_amount: 200,
    status: "active",
    views_count: 89,
    created_at: "2024-01-11T15:10:00Z",
    image_url: "https://images.unsplash.com/photo-1515562141207-7a88fb7ce338?w=500",
    user: {
      id: 5,
      name: "Isabelle Petit",
      avatar: "https://randomuser.me/api/portraits/women/3.jpg"
    }
  },
  {
    id: 6,
    title: "Trouvé - Lunettes de vue",
    description: "Trouvé des lunettes de vue Ray-Ban noires dans leur étui près du café. Verres correcteurs.",
    type: "found",
    category: "Accessoires",
    location: "Rue de Rivoli, Paris",
    contact_phone: "0667890123",
    status: "active",
    views_count: 23,
    created_at: "2024-01-10T11:30:00Z",
    image_url: "https://images.unsplash.com/photo-1591076482161-42ce6da69f67?w=500",
    user: {
      id: 6,
      name: "Lucas Moreau",
      avatar: "https://randomuser.me/api/portraits/men/3.jpg"
    }
  },
  {
    id: 7,
    title: "Perdu - Ordinateur portable MacBook",
    description: "MacBook Pro 13 pouces perdu dans un taxi. Autocollants distinctifs sur le capot. Récompense importante.",
    type: "lost",
    category: "Électronique",
    location: "Paris 8ème",
    contact_phone: "0678901234",
    has_reward: true,
    reward_amount: 300,
    status: "active",
    views_count: 145,
    created_at: "2024-01-09T17:45:00Z",
    image_url: "https://images.unsplash.com/photo-1517336714731-489689fd1ca4?w=500",
    user: {
      id: 7,
      name: "Thomas Richard",
      avatar: "https://randomuser.me/api/portraits/men/4.jpg"
    }
  },
  {
    id: 8,
    title: "Trouvé - Peluche lapin",
    description: "Trouvé une peluche lapin rose très aimée près des balançoires. Un enfant doit beaucoup la chercher.",
    type: "found",
    category: "Jouets",
    location: "Jardin du Luxembourg, Paris",
    contact_phone: "0689012345",
    status: "active",
    views_count: 67,
    created_at: "2024-01-08T14:20:00Z",
    image_url: "https://images.unsplash.com/photo-1559454403-b8fb88521f11?w=500",
    user: {
      id: 8,
      name: "Emma Laurent",
      avatar: "https://randomuser.me/api/portraits/women/4.jpg"
    }
  },
  {
    id: 9,
    title: "Perdu - Sac à main noir",
    description: "Sac à main Michael Kors noir perdu dans le métro ligne 1. Contient des documents importants.",
    type: "lost",
    category: "Accessoires",
    location: "Métro ligne 1, Paris",
    contact_phone: "0690123456",
    has_reward: true,
    reward_amount: 80,
    status: "active",
    views_count: 92,
    created_at: "2024-01-07T19:15:00Z",
    image_url: "https://images.unsplash.com/photo-1584917865442-de89df76afd3?w=500",
    user: {
      id: 9,
      name: "Julie Dubois",
      avatar: "https://randomuser.me/api/portraits/women/5.jpg"
    }
  },
  {
    id: 10,
    title: "Trouvé - Montre connectée",
    description: "Trouvé une Apple Watch Series 7 sur la terrasse d'un café. En bon état, allumée mais verrouillée.",
    type: "found",
    category: "Électronique",
    location: "Montmartre, Paris",
    contact_phone: "0601234567",
    status: "active",
    views_count: 78,
    created_at: "2024-01-06T13:40:00Z",
    image_url: "https://images.unsplash.com/photo-1579586337278-3befd40fd17a?w=500",
    user: {
      id: 10,
      name: "Antoine Martin",
      avatar: "https://randomuser.me/api/portraits/men/5.jpg"
    }
  }
];
