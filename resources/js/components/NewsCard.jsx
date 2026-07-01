import { Link } from 'react-router-dom';

export default function NewsCard({ item }) {
    return (
        <Link
            to={`/news/${item.slug}`}
            className="block bg-white rounded-lg shadow-md p-6 hover:shadow-xl transition-shadow"
        >
            <h3 className="font-bold text-lg mb-1 hover:text-indigo-600 transition-colors">
                {item.title}
            </h3>
            <p className="text-sm text-gray-500 mb-3">
                {item.published_at && new Date(item.published_at).toLocaleDateString('it-IT')}
                {item.game && <> &middot; {item.game.title}</>}
            </p>
            <p className="text-gray-700 line-clamp-2">
                {item.content}
            </p>
        </Link>
    );
}
