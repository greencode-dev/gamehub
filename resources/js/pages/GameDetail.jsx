import { useParams, Link } from 'react-router-dom';
import { useQuery } from '@tanstack/react-query';
import api from '../api/client';

export default function GameDetail() {
    const { slug } = useParams();

    const { data: game, isLoading } = useQuery({
        queryKey: ['game', slug],
        queryFn: () => api.get(`/games/${slug}`).then(r => r.data),
    });

    if (isLoading) {
        return (
            <div className="max-w-4xl mx-auto px-4 py-8">
                <div className="bg-white rounded-lg shadow-md p-8 animate-pulse h-96" />
            </div>
        );
    }

    if (!game) {
        return (
            <div className="max-w-4xl mx-auto px-4 py-8 text-center">
                <h1 className="text-2xl font-bold">Gioco non trovato</h1>
                <Link to="/" className="text-indigo-600 hover:underline mt-4 inline-block">Torna alla homepage</Link>
            </div>
        );
    }

    const coverUrl = game.cover_path ? `/storage/${game.cover_path}` : null;

    return (
        <div className="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
            <Link to="/" className="text-indigo-600 hover:underline mb-4 inline-block">&larr; Torna ai giochi</Link>

            <div className="bg-white rounded-lg shadow-md overflow-hidden">
                <div className="grid grid-cols-1 md:grid-cols-3 gap-8 p-8">
                    <div>
                        {coverUrl ? (
                            <img src={coverUrl} alt={game.title} className="w-full rounded-lg shadow" />
                        ) : (
                            <div className="w-full aspect-[3/4] bg-gradient-to-br from-indigo-500 to-purple-600 rounded-lg flex items-center justify-center text-white text-4xl font-bold">
                                {game.title.charAt(0)}
                            </div>
                        )}
                    </div>

                    <div className="md:col-span-2">
                        <h1 className="text-3xl font-bold mb-4">{game.title}</h1>

                        <div className="grid grid-cols-2 gap-4 mb-6">
                            <div>
                                <p className="text-sm text-gray-500">Editore</p>
                                <p className="font-medium">{game.publisher}</p>
                            </div>
                            <div>
                                <p className="text-sm text-gray-500">Genere</p>
                                <p className="font-medium">{game.genre?.name ?? '-'}</p>
                            </div>
                            <div>
                                <p className="text-sm text-gray-500">Data di uscita</p>
                                <p className="font-medium">
                                    {game.release_date ? new Date(game.release_date).toLocaleDateString('it-IT') : '-'}
                                </p>
                            </div>
                            <div>
                                <p className="text-sm text-gray-500">Prezzo</p>
                                <p className="font-medium text-indigo-600">&euro;{parseFloat(game.price).toFixed(2)}</p>
                            </div>
                        </div>

                        {game.description && (
                            <div className="mb-6">
                                <h2 className="text-lg font-semibold mb-2">Descrizione</h2>
                                <p className="text-gray-700">{game.description}</p>
                            </div>
                        )}

                        <div className="mb-6">
                            <h2 className="text-lg font-semibold mb-2">Piattaforme</h2>
                            <div className="flex flex-wrap gap-2">
                                {game.platforms?.length > 0 ? game.platforms.map(platform => (
                                    <span key={platform.id} className="bg-indigo-100 text-indigo-800 rounded-full px-3 py-1 text-sm font-medium">
                                        {platform.name}
                                    </span>
                                )) : <p className="text-gray-500">Nessuna piattaforma</p>}
                            </div>
                        </div>

                        {game.news?.length > 0 && (
                            <div>
                                <h2 className="text-lg font-semibold mb-2">News correlate</h2>
                                <div className="space-y-2">
                                    {game.news.map(item => (
                                        <Link
                                            key={item.id}
                                            to={`/news/${item.slug}`}
                                            className="block p-3 bg-gray-50 rounded hover:bg-gray-100 transition"
                                        >
                                            <p className="font-medium text-sm">{item.title}</p>
                                            <p className="text-xs text-gray-500">
                                                {item.published_at ? new Date(item.published_at).toLocaleDateString('it-IT') : ''}
                                            </p>
                                        </Link>
                                    ))}
                                </div>
                            </div>
                        )}
                    </div>
                </div>
            </div>
        </div>
    );
}
