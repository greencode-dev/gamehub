import { Link } from 'react-router-dom';

export default function Navbar() {
    return (
        <nav className="bg-gray-900 text-white shadow-lg">
            <div className="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div className="flex justify-between h-16 items-center">
                    <Link to="/" className="text-xl font-bold tracking-tight">
                        GameHub
                    </Link>
                    <div className="flex gap-6">
                        <Link to="/" className="hover:text-indigo-400 transition">Giochi</Link>
                        <Link to="/news" className="hover:text-indigo-400 transition">News</Link>
                    </div>
                </div>
            </div>
        </nav>
    );
}
