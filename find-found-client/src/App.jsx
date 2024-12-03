import { BrowserRouter as Router, Routes, Route } from 'react-router-dom';
import { QueryClient, QueryClientProvider } from '@tanstack/react-query';
import { AuthProvider } from './contexts/AuthContext';
import Navbar from './components/Navbar';
import Home from './pages/Home';
import PostsList from './components/PostsList';
import PostDetail from './pages/PostDetail';
import Profile from './pages/Profile';
import Login from './pages/Login';
import Register from './pages/Register';

const queryClient = new QueryClient();

function AppContent() {
  return (
    <div className="min-h-screen flex flex-col">
      <Navbar />
      <main className="flex-grow">
        <div className="content-container h-full">
          <Routes>
            <Route path="/" element={<Home />} />
            <Route path="/login" element={<Login />} />
            <Route path="/register" element={<Register />} />
            <Route path="/profile" element={<Profile />} />
            <Route path="/lost" element={<PostsList defaultType="lost" />} />
            <Route path="/found" element={<PostsList defaultType="found" />} />
            <Route path="/posts" element={<PostsList />} />
            <Route path="/posts/:id" element={<PostDetail />} />
          </Routes>
        </div>
      </main>
    </div>
  );
}

function App() {
  return (
    <QueryClientProvider client={queryClient}>
      <Router>
        <AuthProvider>
          <AppContent />
        </AuthProvider>
      </Router>
    </QueryClientProvider>
  );
}

export default App;
