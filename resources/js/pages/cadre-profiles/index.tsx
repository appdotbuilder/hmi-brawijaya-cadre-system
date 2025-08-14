import React from 'react';
import { Head, Link } from '@inertiajs/react';
import AppLayout from '@/components/app-layout';
import { Button } from '@/components/ui/button';
import { Card, CardContent, CardDescription, CardHeader, CardTitle } from '@/components/ui/card';
import { type BreadcrumbItem } from '@/types';

interface CadreProfile {
    id: number;
    nik: string | null;
    full_name: string;
    komisariat: string;
    membership_status: string;
    is_verified: boolean;
    user: {
        name: string;
        email: string;
    };
    [key: string]: unknown;
}

interface Props {
    profiles: {
        data: CadreProfile[];
        current_page: number;
        last_page: number;
    };
    [key: string]: unknown;
}

const breadcrumbs: BreadcrumbItem[] = [
    { title: 'Dashboard', href: '/dashboard' },
    { title: 'Profil Kader', href: '/cadre-profiles' },
];

export default function CadreProfilesIndex({ profiles }: Props) {
    return (
        <AppLayout breadcrumbs={breadcrumbs}>
            <Head title="Profil Kader" />
            
            <div className="space-y-6">
                {/* Header */}
                <div className="flex justify-between items-center">
                    <div>
                        <h1 className="text-2xl font-bold text-gray-900">👤 Profil Kader</h1>
                        <p className="text-gray-600 mt-1">
                            Kelola data dan informasi kader HMI Hukum Brawijaya
                        </p>
                    </div>
                    <Link href="/cadre-profiles/create">
                        <Button className="bg-emerald-600 hover:bg-emerald-700">
                            ➕ Tambah Profil
                        </Button>
                    </Link>
                </div>

                {/* Filters */}
                <div className="flex flex-wrap gap-2">
                    <Button variant="outline" size="sm">
                        📊 Semua Kader
                    </Button>
                    <Button variant="outline" size="sm">
                        ✅ Terverifikasi
                    </Button>
                    <Button variant="outline" size="sm">
                        ⏳ Belum Verifikasi
                    </Button>
                    <Button variant="outline" size="sm">
                        💪 Aktif
                    </Button>
                </div>

                {/* Profiles Grid */}
                <div className="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                    {profiles.data.map((profile) => (
                        <Card key={profile.id} className="hover:shadow-lg transition-shadow">
                            <CardHeader>
                                <div className="flex items-start justify-between">
                                    <div className="flex items-center space-x-3">
                                        <div className="w-12 h-12 bg-emerald-100 rounded-full flex items-center justify-center">
                                            <span className="text-xl">👤</span>
                                        </div>
                                        <div>
                                            <CardTitle className="text-lg">{profile.full_name}</CardTitle>
                                            <CardDescription>{profile.user.email}</CardDescription>
                                        </div>
                                    </div>
                                    {profile.is_verified ? (
                                        <span className="bg-emerald-100 text-emerald-800 text-xs font-medium px-2 py-1 rounded-full">
                                            ✅ Verified
                                        </span>
                                    ) : (
                                        <span className="bg-yellow-100 text-yellow-800 text-xs font-medium px-2 py-1 rounded-full">
                                            ⏳ Pending
                                        </span>
                                    )}
                                </div>
                            </CardHeader>
                            <CardContent>
                                <div className="space-y-2">
                                    <div className="flex justify-between text-sm">
                                        <span className="text-gray-600">NIK:</span>
                                        <span className="font-medium">
                                            {profile.nik || 'Belum diassign'}
                                        </span>
                                    </div>
                                    <div className="flex justify-between text-sm">
                                        <span className="text-gray-600">Komisariat:</span>
                                        <span className="font-medium">{profile.komisariat}</span>
                                    </div>
                                    <div className="flex justify-between text-sm">
                                        <span className="text-gray-600">Status:</span>
                                        <span className={`font-medium ${
                                            profile.membership_status === 'active' 
                                                ? 'text-green-600' 
                                                : profile.membership_status === 'inactive'
                                                ? 'text-yellow-600'
                                                : 'text-blue-600'
                                        }`}>
                                            {profile.membership_status === 'active' ? '💪 Aktif' :
                                             profile.membership_status === 'inactive' ? '😴 Non-aktif' :
                                             '🎓 Alumni'}
                                        </span>
                                    </div>
                                </div>
                                
                                <div className="mt-4 flex space-x-2">
                                    <Link 
                                        href={`/cadre-profiles/${profile.id}`}
                                        className="flex-1"
                                    >
                                        <Button variant="outline" className="w-full" size="sm">
                                            👁️ Lihat
                                        </Button>
                                    </Link>
                                    <Link 
                                        href={`/cadre-profiles/${profile.id}/edit`}
                                        className="flex-1"
                                    >
                                        <Button variant="outline" className="w-full" size="sm">
                                            ✏️ Edit
                                        </Button>
                                    </Link>
                                </div>
                            </CardContent>
                        </Card>
                    ))}
                </div>

                {/* Empty State */}
                {profiles.data.length === 0 && (
                    <div className="text-center py-12">
                        <div className="w-24 h-24 bg-gray-100 rounded-full flex items-center justify-center mx-auto mb-4">
                            <span className="text-4xl">👤</span>
                        </div>
                        <h3 className="text-lg font-semibold text-gray-900 mb-2">
                            Belum ada profil kader
                        </h3>
                        <p className="text-gray-600 mb-4">
                            Mulai dengan menambahkan profil kader pertama untuk sistem informasi.
                        </p>
                        <Link href="/cadre-profiles/create">
                            <Button className="bg-emerald-600 hover:bg-emerald-700">
                                ➕ Tambah Profil Kader
                            </Button>
                        </Link>
                    </div>
                )}

                {/* Pagination */}
                {profiles.last_page > 1 && (
                    <div className="flex justify-center space-x-2">
                        <Button 
                            variant="outline" 
                            disabled={profiles.current_page === 1}
                        >
                            ← Sebelumnya
                        </Button>
                        <span className="px-4 py-2 text-sm text-gray-600">
                            Halaman {profiles.current_page} dari {profiles.last_page}
                        </span>
                        <Button 
                            variant="outline" 
                            disabled={profiles.current_page === profiles.last_page}
                        >
                            Selanjutnya →
                        </Button>
                    </div>
                )}
            </div>
        </AppLayout>
    );
}