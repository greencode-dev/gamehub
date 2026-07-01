import { Outlet } from 'react-router-dom';
import Navbar from './Navbar';

export default function Layout() {
    return (
        <div className="min-h-screen flex flex-col">
            <Navbar />
            <main className="flex-1">
                <Outlet />
            </main>
            <footer className="bg-gray-900 text-gray-400 text-center py-4 text-sm">
                &copy; {new Date().getFullYear()} GameHub. Tutti i diritti riservati.
            </footer>
        </div>
    );
}
