import { Link } from 'react-router-dom';

export default function GameCard({ game }) {
    const coverUrl = game.cover_path
        ? `/storage/${game.cover_path}`
        : null;

    return (
        <Link
            to={`/games/${game.slug}`}
            className="bg-white rounded-lg shadow-md overflow-hidden hover:shadow-xl transition-shadow group"
        >
            {coverUrl ? (
                <img
                    src={coverUrl}
                    alt={game.title}
                    className="w-full h-48 object-cover group-hover:scale-105 transition-transform"
                />
            ) : (
                <div className="w-full h-48 bg-gradient-to-br from-indigo-500 to-purple-600 flex items-center justify-center text-white text-lg font-bold">
                    {game.title.charAt(0)}
                </div>
            )}
            <div className="p-4">
                <h3 className="font-bold text-lg mb-1 group-hover:text-indigo-600 transition-colors">
                    {game.title}
                </h3>
                <p className="text-sm text-gray-500 mb-2">{game.genre?.name}</p>
                <div className="flex flex-wrap gap-1 mb-2">
                    {game.platforms?.map(platform => (
                        <span key={platform.id} className="text-xs bg-gray-100 rounded px-2 py-0.5">
                            {platform.name}
                        </span>
                    ))}
                </div>
                <p className="text-indigo-600 font-bold">&euro;{parseFloat(game.price).toFixed(2)}</p>
            </div>
        </Link>
    );
}
