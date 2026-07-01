import { BrowserRouter, Routes, Route } from 'react-router-dom';
import Layout from './components/Layout';
import Home from './pages/Home';
import GameDetail from './pages/GameDetail';
import News from './pages/News';
import NewsDetail from './pages/NewsDetail';

export default function App() {
    return (
        <BrowserRouter>
            <Routes>
                <Route element={<Layout />}>
                    <Route path="/" element={<Home />} />
                    <Route path="/games/:slug" element={<GameDetail />} />
                    <Route path="/news" element={<News />} />
                    <Route path="/news/:slug" element={<NewsDetail />} />
                </Route>
            </Routes>
        </BrowserRouter>
    );
}
