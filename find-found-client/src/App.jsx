import { BrowserRouter as Router, Routes, Route } from 'react-router-dom';
import { QueryClient, QueryClientProvider } from '@tanstack/react-query';
import { AuthProvider } from './contexts/AuthContext';
import Navbar from './components/Navbar';
import Home from './pages/Home';
import PostsList from './components/PostsList';
import PostDetail from './pages/PostDetail';
import Login from './pages/Login';
import Register from './pages/Register';

const queryClient = new QueryClient();

function AppContent() {
  return (
    <Router>
      <div className="min-h-screen flex flex-col">
        <Navbar />
        <main className="flex-grow">
          <div className="content-container h-full">
            <Routes>
              <Route path="/" element={<Home />} />
              <Route path="/login" element={<Login />} />
              <Route path="/register" element={<Register />} />
              <Route path="/lost" element={<PostsList defaultType="lost" />} />
              <Route path="/found" element={<PostsList defaultType="found" />} />
              <Route path="/posts" element={<PostsList />} />
              <Route path="/posts/:id" element={<PostDetail />} />
            </Routes>
          </div>
        </main>
      </div>
    </Router>
  );
}

function App() {
  return (
    <QueryClientProvider client={queryClient}>
      <AuthProvider>
        <AppContent />
      </AuthProvider>
    </QueryClientProvider>
  );
}

export default App;
