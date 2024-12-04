import api from './api';

export const likeService = {
  // Récupérer tous les likes d'un post
  getLikes: async (postId) => {
    const response = await api.get(`/posts/${postId}/likes`);
    return response.data;
  },

  // Récupérer le nombre de likes et si l'utilisateur a liké
  getLikeCount: async (postId) => {
    const response = await api.get(`/posts/${postId}/likes/count`);
    return response.data;
  },

  // Basculer le like d'un post (like/unlike)
  toggleLike: async (postId) => {
    const response = await api.post(`/posts/${postId}/like`);
    return response.data;
  }
};
