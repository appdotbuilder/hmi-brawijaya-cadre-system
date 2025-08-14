import React from 'react';
import { Head, Link } from '@inertiajs/react';
import AppLayout from '@/components/app-layout';
import { Button } from '@/components/ui/button';
import { Card, CardContent, CardDescription, CardHeader, CardTitle } from '@/components/ui/card';
import { type BreadcrumbItem } from '@/types';

interface LibraryItem {
    id: number;
    title: string;
    author: string;
    description: string | null;
    type: 'digital' | 'print';
    category: string | null;
    publication_year: number | null;
    digital_url: string | null;
    available_copies: number;
    total_copies: number;
    cover_image: string | null;
    [key: string]: unknown;
}

interface Props {
    items: {
        data: LibraryItem[];
        current_page: number;
        last_page: number;
    };
    [key: string]: unknown;
}

const breadcrumbs: BreadcrumbItem[] = [
    { title: 'Dashboard', href: '/dashboard' },
    { title: 'Perpustakaan', href: '/library' },
];

export default function LibraryIndex({ items }: Props) {
    return (
        <AppLayout breadcrumbs={breadcrumbs}>
            <Head title="Perpustakaan Komisariat" />
            
            <div className="space-y-6">
                {/* Header */}
                <div className="flex justify-between items-center">
                    <div>
                        <h1 className="text-2xl font-bold text-gray-900">📚 Perpustakaan Komisariat</h1>
                        <p className="text-gray-600 mt-1">
                            Koleksi buku dan resources HMI Hukum Brawijaya
                        </p>
                    </div>
                    <Link href="/library/create">
                        <Button className="bg-blue-600 hover:bg-blue-700">
                            ➕ Tambah Koleksi
                        </Button>
                    </Link>
                </div>

                {/* Filters */}
                <div className="flex flex-wrap gap-2">
                    <Button variant="outline" size="sm">
                        📖 Semua Koleksi
                    </Button>
                    <Button variant="outline" size="sm">
                        💻 Digital
                    </Button>
                    <Button variant="outline" size="sm">
                        📚 Cetak
                    </Button>
                    <Button variant="outline" size="sm">
                        ✅ Tersedia
                    </Button>
                </div>

                {/* Search */}
                <div className="max-w-md">
                    <input
                        type="text"
                        placeholder="🔍 Cari judul, penulis, atau kategori..."
                        className="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                    />
                </div>

                {/* Items Grid */}
                <div className="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6">
                    {items.data.map((item) => (
                        <Card key={item.id} className="hover:shadow-lg transition-shadow">
                            <CardHeader>
                                <div className="flex items-start space-x-3">
                                    <div className="w-16 h-20 bg-gradient-to-br from-blue-100 to-blue-200 rounded-lg flex items-center justify-center flex-shrink-0">
                                        <span className="text-2xl">
                                            {item.type === 'digital' ? '💻' : '📚'}
                                        </span>
                                    </div>
                                    <div className="flex-1 min-w-0">
                                        <CardTitle className="text-base line-clamp-2" title={item.title}>
                                            {item.title}
                                        </CardTitle>
                                        <CardDescription className="line-clamp-1" title={item.author}>
                                            {item.author}
                                        </CardDescription>
                                        {item.publication_year && (
                                            <p className="text-xs text-gray-500 mt-1">
                                                📅 {item.publication_year}
                                            </p>
                                        )}
                                    </div>
                                </div>
                            </CardHeader>
                            <CardContent>
                                <div className="space-y-3">
                                    {/* Type and Category */}
                                    <div className="flex items-center justify-between text-xs">
                                        <span className={`px-2 py-1 rounded-full font-medium ${
                                            item.type === 'digital' 
                                                ? 'bg-green-100 text-green-800' 
                                                : 'bg-blue-100 text-blue-800'
                                        }`}>
                                            {item.type === 'digital' ? '💻 Digital' : '📚 Cetak'}
                                        </span>
                                        {item.category && (
                                            <span className="bg-gray-100 text-gray-700 px-2 py-1 rounded-full">
                                                {item.category}
                                            </span>
                                        )}
                                    </div>

                                    {/* Availability */}
                                    {item.type === 'print' && (
                                        <div className="text-sm">
                                            <span className="text-gray-600">Tersedia: </span>
                                            <span className={`font-medium ${
                                                item.available_copies > 0 ? 'text-green-600' : 'text-red-600'
                                            }`}>
                                                {item.available_copies}/{item.total_copies}
                                            </span>
                                        </div>
                                    )}

                                    {/* Description */}
                                    {item.description && (
                                        <p className="text-sm text-gray-600 line-clamp-2" title={item.description}>
                                            {item.description}
                                        </p>
                                    )}

                                    {/* Actions */}
                                    <div className="flex space-x-2">
                                        <Link 
                                            href={`/library/${item.id}`}
                                            className="flex-1"
                                        >
                                            <Button variant="outline" className="w-full" size="sm">
                                                👁️ Detail
                                            </Button>
                                        </Link>
                                        
                                        {item.type === 'digital' ? (
                                            item.digital_url && (
                                                <a 
                                                    href={item.digital_url}
                                                    target="_blank"
                                                    rel="noopener noreferrer"
                                                    className="flex-1"
                                                >
                                                    <Button className="w-full bg-green-600 hover:bg-green-700" size="sm">
                                                        🔗 Buka
                                                    </Button>
                                                </a>
                                            )
                                        ) : (
                                            item.available_copies > 0 && (
                                                <Link 
                                                    href={`/library/${item.id}#loan`}
                                                    className="flex-1"
                                                >
                                                    <Button className="w-full bg-blue-600 hover:bg-blue-700" size="sm">
                                                        📋 Pinjam
                                                    </Button>
                                                </Link>
                                            )
                                        )}
                                    </div>
                                </div>
                            </CardContent>
                        </Card>
                    ))}
                </div>

                {/* Empty State */}
                {items.data.length === 0 && (
                    <div className="text-center py-12">
                        <div className="w-24 h-24 bg-gray-100 rounded-full flex items-center justify-center mx-auto mb-4">
                            <span className="text-4xl">📚</span>
                        </div>
                        <h3 className="text-lg font-semibold text-gray-900 mb-2">
                            Koleksi perpustakaan kosong
                        </h3>
                        <p className="text-gray-600 mb-4">
                            Mulai membangun koleksi perpustakaan digital dan fisik untuk kader.
                        </p>
                        <Link href="/library/create">
                            <Button className="bg-blue-600 hover:bg-blue-700">
                                ➕ Tambah Koleksi Pertama
                            </Button>
                        </Link>
                    </div>
                )}

                {/* Pagination */}
                {items.last_page > 1 && (
                    <div className="flex justify-center space-x-2">
                        <Button 
                            variant="outline" 
                            disabled={items.current_page === 1}
                        >
                            ← Sebelumnya
                        </Button>
                        <span className="px-4 py-2 text-sm text-gray-600">
                            Halaman {items.current_page} dari {items.last_page}
                        </span>
                        <Button 
                            variant="outline" 
                            disabled={items.current_page === items.last_page}
                        >
                            Selanjutnya →
                        </Button>
                    </div>
                )}
            </div>
        </AppLayout>
    );
}