import { useQuery } from '@tanstack/react-query';
import api from '../api/client';
import GameCard from '../components/GameCard';
import NewsCard from '../components/NewsCard';

export default function Home() {
    const { data: gamesData, isLoading: gamesLoading } = useQuery({
        queryKey: ['games'],
        queryFn: () => api.get('/games').then(r => r.data),
    });

    const { data: newsData, isLoading: newsLoading } = useQuery({
        queryKey: ['news'],
        queryFn: () => api.get('/news').then(r => r.data),
    });

    return (
        <div className="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
            <section className="mb-12">
                <div className="flex justify-between items-center mb-6">
                    <h1 className="text-3xl font-bold">Giochi in evidenza</h1>
                </div>

                {gamesLoading ? (
                    <div className="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6">
                        {Array.from({ length: 8 }).map((_, i) => (
                            <div key={i} className="bg-white rounded-lg shadow-md h-80 animate-pulse" />
                        ))}
                    </div>
                ) : (
                    <div className="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6">
                        {gamesData?.data?.map(game => (
                            <GameCard key={game.id} game={game} />
                        ))}
                    </div>
                )}
            </section>

            <section>
                <div className="flex justify-between items-center mb-6">
                    <h2 className="text-2xl font-bold">Ultime News</h2>
                </div>

                {newsLoading ? (
                    <div className="grid grid-cols-1 md:grid-cols-2 gap-6">
                        {Array.from({ length: 4 }).map((_, i) => (
                            <div key={i} className="bg-white rounded-lg shadow-md h-32 animate-pulse" />
                        ))}
                    </div>
                ) : (
                    <div className="grid grid-cols-1 md:grid-cols-2 gap-6">
                        {newsData?.data?.slice(0, 4).map(item => (
                            <NewsCard key={item.id} item={item} />
                        ))}
                    </div>
                )}
            </section>
        </div>
    );
}
