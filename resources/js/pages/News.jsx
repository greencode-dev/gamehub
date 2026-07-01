import { useQuery } from '@tanstack/react-query';
import api from '../api/client';
import NewsCard from '../components/NewsCard';

export default function News() {
    const { data, isLoading } = useQuery({
        queryKey: ['news'],
        queryFn: () => api.get('/news').then(r => r.data),
    });

    return (
        <div className="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
            <h1 className="text-3xl font-bold mb-6">News</h1>

            {isLoading ? (
                <div className="space-y-4">
                    {Array.from({ length: 6 }).map((_, i) => (
                        <div key={i} className="bg-white rounded-lg shadow-md h-24 animate-pulse" />
                    ))}
                </div>
            ) : (
                <div className="space-y-4">
                    {data?.data?.map(item => (
                        <NewsCard key={item.id} item={item} />
                    ))}
                </div>
            )}
        </div>
    );
}
