import React from 'react';
import { Head, Link, usePage } from '@inertiajs/react';
import AppLayout from '@/components/app-layout';
import { Button } from '@/components/ui/button';
import { Card, CardContent, CardDescription, CardHeader, CardTitle } from '@/components/ui/card';
import { type BreadcrumbItem } from '@/types';

interface Props {
    auth: {
        user: {
            name: string;
            role: string;
            is_verified: boolean;
        };
    };
    totalCadres?: number;
    totalLibraryItems?: number;
    totalActiveLoans?: number;
    upcomingEvents?: number;
    [key: string]: unknown;
}

const breadcrumbs: BreadcrumbItem[] = [
    {
        title: 'Dashboard',
        href: '/dashboard',
    },
];

export default function Dashboard() {
    const { auth } = usePage<Props>().props;
    const user = auth.user;

    return (
        <AppLayout breadcrumbs={breadcrumbs}>
            <Head title="Dashboard" />
            
            <div className="space-y-6">
                {/* Welcome Section */}
                <div className="bg-gradient-to-r from-emerald-600 to-blue-600 rounded-xl p-6 text-white">
                    <div className="flex items-center space-x-4">
                        <div className="w-16 h-16 bg-white/20 rounded-full flex items-center justify-center">
                            <span className="text-2xl">🕌</span>
                        </div>
                        <div>
                            <h1 className="text-2xl font-bold">Assalamualaikum, {user.name}</h1>
                            <p className="text-emerald-100">
                                Selamat datang di Sistem Informasi Kader HMI Hukum Brawijaya
                            </p>
                            <div className="mt-2">
                                <span className="inline-flex items-center px-3 py-1 rounded-full text-xs font-medium bg-white/20">
                                    {user.role === 'administrator' ? '👑 Administrator' :
                                     user.role === 'management' ? '⚖️ Pengurus' : '🎓 Kader'}
                                </span>
                                {!user.is_verified && (
                                    <span className="ml-2 inline-flex items-center px-3 py-1 rounded-full text-xs font-medium bg-yellow-500/20">
                                        ⏳ Menunggu Verifikasi
                                    </span>
                                )}
                            </div>
                        </div>
                    </div>
                </div>

                {/* Quick Actions */}
                <div className="grid grid-cols-1 md:grid-cols-3 gap-6">
                    <Card>
                        <CardHeader>
                            <CardTitle className="flex items-center space-x-2">
                                <span className="text-2xl">👤</span>
                                <span>Profil Saya</span>
                            </CardTitle>
                            <CardDescription>
                                Kelola informasi profil kader Anda
                            </CardDescription>
                        </CardHeader>
                        <CardContent>
                            <Link href="/cadre-profiles">
                                <Button className="w-full bg-emerald-600 hover:bg-emerald-700">
                                    Lihat Profil
                                </Button>
                            </Link>
                        </CardContent>
                    </Card>

                    <Card>
                        <CardHeader>
                            <CardTitle className="flex items-center space-x-2">
                                <span className="text-2xl">📚</span>
                                <span>Perpustakaan</span>
                            </CardTitle>
                            <CardDescription>
                                Jelajahi koleksi buku dan resources
                            </CardDescription>
                        </CardHeader>
                        <CardContent>
                            <Link href="/library">
                                <Button className="w-full bg-blue-600 hover:bg-blue-700">
                                    Buka Perpustakaan
                                </Button>
                            </Link>
                        </CardContent>
                    </Card>

                    <Card>
                        <CardHeader>
                            <CardTitle className="flex items-center space-x-2">
                                <span className="text-2xl">✅</span>
                                <span>Kehadiran</span>
                            </CardTitle>
                            <CardDescription>
                                Lihat dan isi absensi kegiatan
                            </CardDescription>
                        </CardHeader>
                        <CardContent>
                            <Link href="/attendance">
                                <Button className="w-full bg-purple-600 hover:bg-purple-700">
                                    Lihat Kehadiran
                                </Button>
                            </Link>
                        </CardContent>
                    </Card>
                </div>

                {/* Admin/Management Quick Actions */}
                {(user.role === 'administrator' || user.role === 'management') && (
                    <div className="bg-white border-2 border-dashed border-gray-300 rounded-xl p-6">
                        <h2 className="text-lg font-semibold text-gray-900 mb-4 flex items-center">
                            <span className="text-2xl mr-2">⚡</span>
                            Aksi Cepat {user.role === 'administrator' ? 'Administrator' : 'Pengurus'}
                        </h2>
                        <div className="grid grid-cols-2 md:grid-cols-4 gap-4">
                            {user.role === 'administrator' && (
                                <>
                                    <Link href="/cadre-profiles?filter=unverified">
                                        <Button variant="outline" className="w-full">
                                            ⏳ Verifikasi Kader
                                        </Button>
                                    </Link>
                                    <Link href="/library/create">
                                        <Button variant="outline" className="w-full">
                                            ➕ Tambah Buku
                                        </Button>
                                    </Link>
                                </>
                            )}
                            <Link href="/book-loans?status=pending">
                                <Button variant="outline" className="w-full">
                                    📋 Approve Pinjaman
                                </Button>
                            </Link>
                            <Link href="/attendance/create">
                                <Button variant="outline" className="w-full">
                                    🎯 Buat Event
                                </Button>
                            </Link>
                        </div>
                    </div>
                )}

                {/* Recent Activity */}
                <div className="grid grid-cols-1 lg:grid-cols-2 gap-6">
                    <Card>
                        <CardHeader>
                            <CardTitle className="flex items-center space-x-2">
                                <span className="text-xl">📊</span>
                                <span>Statistik Singkat</span>
                            </CardTitle>
                        </CardHeader>
                        <CardContent className="space-y-4">
                            <div className="flex justify-between items-center">
                                <span className="text-gray-600">Total Kader Aktif</span>
                                <span className="font-semibold text-emerald-600">-</span>
                            </div>
                            <div className="flex justify-between items-center">
                                <span className="text-gray-600">Koleksi Perpustakaan</span>
                                <span className="font-semibold text-blue-600">-</span>
                            </div>
                            <div className="flex justify-between items-center">
                                <span className="text-gray-600">Event Mendatang</span>
                                <span className="font-semibold text-purple-600">-</span>
                            </div>
                        </CardContent>
                    </Card>

                    <Card>
                        <CardHeader>
                            <CardTitle className="flex items-center space-x-2">
                                <span className="text-xl">🔔</span>
                                <span>Pengumuman</span>
                            </CardTitle>
                        </CardHeader>
                        <CardContent>
                            <div className="space-y-3">
                                <div className="p-3 bg-emerald-50 border border-emerald-200 rounded-lg">
                                    <p className="text-sm text-emerald-800">
                                        🎉 Sistem Informasi Kader HMI Hukum Brawijaya telah aktif! 
                                        Silakan lengkapi profil Anda untuk akses penuh.
                                    </p>
                                </div>
                                {!user.is_verified && (
                                    <div className="p-3 bg-yellow-50 border border-yellow-200 rounded-lg">
                                        <p className="text-sm text-yellow-800">
                                            ⏳ Akun Anda sedang dalam proses verifikasi oleh Administrator. 
                                            Harap tunggu untuk mendapatkan akses penuh.
                                        </p>
                                    </div>
                                )}
                            </div>
                        </CardContent>
                    </Card>
                </div>
            </div>
        </AppLayout>
    );
}