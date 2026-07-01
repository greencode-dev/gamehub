import { useParams, Link } from 'react-router-dom';
import { useQuery } from '@tanstack/react-query';
import api from '../api/client';

export default function NewsDetail() {
    const { slug } = useParams();

    const { data: item, isLoading } = useQuery({
        queryKey: ['news', slug],
        queryFn: () => api.get(`/news/${slug}`).then(r => r.data),
    });

    if (isLoading) {
        return (
            <div className="max-w-3xl mx-auto px-4 py-8">
                <div className="bg-white rounded-lg shadow-md p-8 animate-pulse h-64" />
            </div>
        );
    }

    if (!item) {
        return (
            <div className="max-w-3xl mx-auto px-4 py-8 text-center">
                <h1 className="text-2xl font-bold">News non trovata</h1>
                <Link to="/news" className="text-indigo-600 hover:underline mt-4 inline-block">Torna alle news</Link>
            </div>
        );
    }

    const imageUrl = item.image_path ? `/storage/${item.image_path}` : null;

    return (
        <div className="max-w-3xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
            <Link to="/news" className="text-indigo-600 hover:underline mb-4 inline-block">&larr; Torna alle news</Link>

            <article className="bg-white rounded-lg shadow-md overflow-hidden">
                {imageUrl && (
                    <img src={imageUrl} alt={item.title} className="w-full h-64 object-cover" />
                )}
                <div className="p-8">
                    <h1 className="text-3xl font-bold mb-2">{item.title}</h1>
                    <p className="text-sm text-gray-500 mb-6">
                        {item.published_at && new Date(item.published_at).toLocaleDateString('it-IT')}
                        {item.game && <> &middot; <Link to={`/games/${item.game.slug}`} className="text-indigo-600 hover:underline">{item.game.title}</Link></>}
                    </p>
                    <div className="text-gray-700 leading-relaxed whitespace-pre-line">
                        {item.content}
                    </div>
                </div>
            </article>
        </div>
    );
}
