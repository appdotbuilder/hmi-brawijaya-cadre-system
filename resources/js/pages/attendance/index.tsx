import React from 'react';
import { Head, Link } from '@inertiajs/react';
import AppLayout from '@/components/app-layout';
import { Button } from '@/components/ui/button';
import { Card, CardContent, CardDescription, CardHeader, CardTitle } from '@/components/ui/card';
import { type BreadcrumbItem } from '@/types';

interface AttendanceEvent {
    id: number;
    title: string;
    description: string | null;
    activity_type: string | null;
    field: string | null;
    department: string | null;
    event_date: string;
    registration_start: string;
    registration_end: string;
    location: string | null;
    max_participants: number | null;
    is_mandatory: boolean;
    target_audience: string;
    target_komisariat: string | null;
    qr_code: string | null;
    attendance_records_count?: number;
    [key: string]: unknown;
}

interface Props {
    events: {
        data: AttendanceEvent[];
        current_page: number;
        last_page: number;
    };
    [key: string]: unknown;
}

const breadcrumbs: BreadcrumbItem[] = [
    { title: 'Dashboard', href: '/dashboard' },
    { title: 'Kehadiran', href: '/attendance' },
];

export default function AttendanceIndex({ events }: Props) {
    const formatDateTime = (dateString: string) => {
        return new Date(dateString).toLocaleString('id-ID', {
            weekday: 'long',
            year: 'numeric',
            month: 'long',
            day: 'numeric',
            hour: '2-digit',
            minute: '2-digit',
        });
    };

    const isRegistrationOpen = (event: AttendanceEvent) => {
        const now = new Date();
        const start = new Date(event.registration_start);
        const end = new Date(event.registration_end);
        return now >= start && now <= end;
    };

    const isEventPassed = (event: AttendanceEvent) => {
        return new Date() > new Date(event.event_date);
    };

    return (
        <AppLayout breadcrumbs={breadcrumbs}>
            <Head title="Kehadiran Online" />
            
            <div className="space-y-6">
                {/* Header */}
                <div className="flex justify-between items-center">
                    <div>
                        <h1 className="text-2xl font-bold text-gray-900">✅ Kehadiran Online</h1>
                        <p className="text-gray-600 mt-1">
                            Sistem absensi fleksibel untuk kegiatan HMI Hukum Brawijaya
                        </p>
                    </div>
                    <Link href="/attendance/create">
                        <Button className="bg-purple-600 hover:bg-purple-700">
                            🎯 Buat Event
                        </Button>
                    </Link>
                </div>

                {/* Filters */}
                <div className="flex flex-wrap gap-2">
                    <Button variant="outline" size="sm">
                        📅 Semua Event
                    </Button>
                    <Button variant="outline" size="sm">
                        🟢 Pendaftaran Terbuka
                    </Button>
                    <Button variant="outline" size="sm">
                        ⚠️ Wajib Hadir
                    </Button>
                    <Button variant="outline" size="sm">
                        ✅ Event Selesai
                    </Button>
                </div>

                {/* Events Grid */}
                <div className="grid grid-cols-1 lg:grid-cols-2 gap-6">
                    {events.data.map((event) => (
                        <Card key={event.id} className={`hover:shadow-lg transition-shadow ${
                            isRegistrationOpen(event) ? 'border-green-300 bg-green-50/30' : ''
                        }`}>
                            <CardHeader>
                                <div className="flex justify-between items-start">
                                    <div>
                                        <CardTitle className="text-xl text-gray-900">
                                            {event.title}
                                        </CardTitle>
                                        <CardDescription className="mt-1">
                                            📅 {formatDateTime(event.event_date)}
                                        </CardDescription>
                                        {event.location && (
                                            <p className="text-sm text-gray-600 mt-1">
                                                📍 {event.location}
                                            </p>
                                        )}
                                    </div>
                                    <div className="flex flex-col items-end space-y-1">
                                        {event.is_mandatory && (
                                            <span className="bg-red-100 text-red-800 text-xs font-medium px-2 py-1 rounded-full">
                                                ⚠️ Wajib
                                            </span>
                                        )}
                                        {isRegistrationOpen(event) ? (
                                            <span className="bg-green-100 text-green-800 text-xs font-medium px-2 py-1 rounded-full">
                                                🟢 Terbuka
                                            </span>
                                        ) : isEventPassed(event) ? (
                                            <span className="bg-gray-100 text-gray-800 text-xs font-medium px-2 py-1 rounded-full">
                                                ✅ Selesai
                                            </span>
                                        ) : (
                                            <span className="bg-yellow-100 text-yellow-800 text-xs font-medium px-2 py-1 rounded-full">
                                                ⏰ Segera
                                            </span>
                                        )}
                                    </div>
                                </div>
                            </CardHeader>
                            <CardContent>
                                <div className="space-y-4">
                                    {/* Description */}
                                    {event.description && (
                                        <p className="text-sm text-gray-600 line-clamp-2">
                                            {event.description}
                                        </p>
                                    )}

                                    {/* Event Details */}
                                    <div className="grid grid-cols-2 gap-4 text-sm">
                                        {event.activity_type && (
                                            <div>
                                                <span className="text-gray-600">Jenis:</span>
                                                <p className="font-medium">{event.activity_type}</p>
                                            </div>
                                        )}
                                        {event.field && (
                                            <div>
                                                <span className="text-gray-600">Bidang:</span>
                                                <p className="font-medium">{event.field}</p>
                                            </div>
                                        )}
                                        {event.department && (
                                            <div>
                                                <span className="text-gray-600">Divisi:</span>
                                                <p className="font-medium">{event.department}</p>
                                            </div>
                                        )}
                                        <div>
                                            <span className="text-gray-600">Target:</span>
                                            <p className="font-medium">
                                                {event.target_audience === 'all' ? '👥 Semua' :
                                                 event.target_audience === 'active_cadres' ? '💪 Kader Aktif' :
                                                 event.target_audience === 'management' ? '⚖️ Pengurus' :
                                                 event.target_komisariat ? `🏛️ ${event.target_komisariat}` : '🎯 Khusus'}
                                            </p>
                                        </div>
                                    </div>

                                    {/* Registration Period */}
                                    <div className="bg-gray-50 p-3 rounded-lg">
                                        <p className="text-sm text-gray-600 mb-1">Pendaftaran:</p>
                                        <p className="text-sm font-medium">
                                            {new Date(event.registration_start).toLocaleDateString('id-ID')} - {' '}
                                            {new Date(event.registration_end).toLocaleDateString('id-ID')}
                                        </p>
                                    </div>

                                    {/* Participants */}
                                    <div className="flex justify-between items-center text-sm">
                                        <span className="text-gray-600">Peserta:</span>
                                        <span className="font-medium">
                                            {event.attendance_records_count || 0}
                                            {event.max_participants && ` / ${event.max_participants}`} orang
                                        </span>
                                    </div>

                                    {/* Actions */}
                                    <div className="flex space-x-2 pt-2">
                                        <Link 
                                            href={`/attendance/${event.id}`}
                                            className="flex-1"
                                        >
                                            <Button variant="outline" className="w-full" size="sm">
                                                📊 Detail
                                            </Button>
                                        </Link>
                                        
                                        {isRegistrationOpen(event) && !isEventPassed(event) && (
                                            <Link 
                                                href={`/attendance/${event.id}#checkin`}
                                                className="flex-1"
                                            >
                                                <Button className="w-full bg-green-600 hover:bg-green-700" size="sm">
                                                    ✅ Check In
                                                </Button>
                                            </Link>
                                        )}
                                        
                                        {event.qr_code && (
                                            <Button variant="outline" size="sm" className="px-3">
                                                📱 QR
                                            </Button>
                                        )}
                                    </div>
                                </div>
                            </CardContent>
                        </Card>
                    ))}
                </div>

                {/* Empty State */}
                {events.data.length === 0 && (
                    <div className="text-center py-12">
                        <div className="w-24 h-24 bg-gray-100 rounded-full flex items-center justify-center mx-auto mb-4">
                            <span className="text-4xl">✅</span>
                        </div>
                        <h3 className="text-lg font-semibold text-gray-900 mb-2">
                            Belum ada event kehadiran
                        </h3>
                        <p className="text-gray-600 mb-4">
                            Buat event pertama untuk mulai tracking kehadiran kader dalam kegiatan.
                        </p>
                        <Link href="/attendance/create">
                            <Button className="bg-purple-600 hover:bg-purple-700">
                                🎯 Buat Event Pertama
                            </Button>
                        </Link>
                    </div>
                )}

                {/* Pagination */}
                {events.last_page > 1 && (
                    <div className="flex justify-center space-x-2">
                        <Button 
                            variant="outline" 
                            disabled={events.current_page === 1}
                        >
                            ← Sebelumnya
                        </Button>
                        <span className="px-4 py-2 text-sm text-gray-600">
                            Halaman {events.current_page} dari {events.last_page}
                        </span>
                        <Button 
                            variant="outline" 
                            disabled={events.current_page === events.last_page}
                        >
                            Selanjutnya →
                        </Button>
                    </div>
                )}
            </div>
        </AppLayout>
    );
}