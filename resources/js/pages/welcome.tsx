import React from 'react';
import { Link } from '@inertiajs/react';
import { Button } from '@/components/ui/button';
import { Card, CardContent, CardDescription, CardHeader, CardTitle } from '@/components/ui/card';

export default function Welcome() {
    return (
        <div className="min-h-screen bg-gradient-to-br from-emerald-50 via-white to-blue-50">
            {/* Navigation */}
            <nav className="border-b bg-white/80 backdrop-blur-sm">
                <div className="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                    <div className="flex justify-between h-16 items-center">
                        <div className="flex items-center space-x-3">
                            <div className="w-10 h-10 bg-emerald-600 rounded-lg flex items-center justify-center">
                                <span className="text-white font-bold text-lg">H</span>
                            </div>
                            <div>
                                <h1 className="font-bold text-gray-900">HMI Hukum Brawijaya</h1>
                                <p className="text-xs text-gray-600">Cadre Information System</p>
                            </div>
                        </div>
                        <div className="flex items-center space-x-4">
                            <Link href="/login">
                                <Button variant="outline">Masuk</Button>
                            </Link>
                            <Link href="/register">
                                <Button className="bg-emerald-600 hover:bg-emerald-700">Daftar</Button>
                            </Link>
                        </div>
                    </div>
                </div>
            </nav>

            {/* Hero Section */}
            <section className="py-20 px-4 sm:px-6 lg:px-8">
                <div className="max-w-7xl mx-auto text-center">
                    <div className="mb-8">
                        <div className="inline-flex items-center bg-emerald-100 text-emerald-800 px-4 py-2 rounded-full text-sm font-medium mb-4">
                            🕌 Sistem Informasi Kader
                        </div>
                        <h1 className="text-4xl sm:text-5xl lg:text-6xl font-bold text-gray-900 mb-6">
                            HMI Hukum Brawijaya
                            <span className="block text-emerald-600">Cadre Information System</span>
                        </h1>
                        <p className="text-xl text-gray-600 max-w-3xl mx-auto mb-8">
                            Sistem informasi terintegrasi untuk mengelola data kader, perpustakaan digital, dan kehadiran kegiatan 
                            Himpunan Mahasiswa Islam Komisariat Hukum Brawijaya
                        </p>
                        <div className="flex flex-col sm:flex-row gap-4 justify-center">
                            <Link href="/register">
                                <Button size="lg" className="bg-emerald-600 hover:bg-emerald-700 text-white px-8">
                                    📝 Daftar Sebagai Kader
                                </Button>
                            </Link>
                            <Link href="/login">
                                <Button size="lg" variant="outline" className="px-8">
                                    🔐 Masuk ke Dashboard
                                </Button>
                            </Link>
                        </div>
                    </div>
                </div>
            </section>

            {/* Features Section */}
            <section className="py-20 bg-white">
                <div className="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                    <div className="text-center mb-16">
                        <h2 className="text-3xl font-bold text-gray-900 mb-4">
                            ✨ Fitur Utama Sistem
                        </h2>
                        <p className="text-lg text-gray-600 max-w-2xl mx-auto">
                            Platform lengkap untuk mendukung aktivitas dan pengembangan kader HMI Hukum Brawijaya
                        </p>
                    </div>

                    <div className="grid md:grid-cols-3 gap-8">
                        <Card className="border-2 hover:border-emerald-300 transition-colors">
                            <CardHeader>
                                <div className="w-12 h-12 bg-emerald-100 rounded-lg flex items-center justify-center mb-4">
                                    <span className="text-2xl">👤</span>
                                </div>
                                <CardTitle className="text-emerald-800">Profil Kader Lengkap</CardTitle>
                                <CardDescription>
                                    Kelola informasi pribadi dan akademik kader secara komprehensif
                                </CardDescription>
                            </CardHeader>
                            <CardContent>
                                <ul className="space-y-2 text-sm text-gray-600">
                                    <li>• Data pribadi dan kontak</li>
                                    <li>• Informasi akademik (NIM, Prodi)</li>
                                    <li>• Status keanggotaan HMI</li>
                                    <li>• Posisi dalam organisasi</li>
                                    <li>• Verifikasi NIK oleh Administrator</li>
                                </ul>
                            </CardContent>
                        </Card>

                        <Card className="border-2 hover:border-blue-300 transition-colors">
                            <CardHeader>
                                <div className="w-12 h-12 bg-blue-100 rounded-lg flex items-center justify-center mb-4">
                                    <span className="text-2xl">📚</span>
                                </div>
                                <CardTitle className="text-blue-800">Perpustakaan Komisariat</CardTitle>
                                <CardDescription>
                                    Koleksi digital dan fisik untuk pengembangan intelektual kader
                                </CardDescription>
                            </CardHeader>
                            <CardContent>
                                <ul className="space-y-2 text-sm text-gray-600">
                                    <li>• Koleksi digital dengan link langsung</li>
                                    <li>• Sistem peminjaman buku fisik</li>
                                    <li>• Persetujuan Admin/Pengurus</li>
                                    <li>• Tracking status peminjaman</li>
                                    <li>• Katalog berdasarkan kategori</li>
                                </ul>
                            </CardContent>
                        </Card>

                        <Card className="border-2 hover:border-purple-300 transition-colors">
                            <CardHeader>
                                <div className="w-12 h-12 bg-purple-100 rounded-lg flex items-center justify-center mb-4">
                                    <span className="text-2xl">✅</span>
                                </div>
                                <CardTitle className="text-purple-800">Absensi Online</CardTitle>
                                <CardDescription>
                                    Sistem kehadiran fleksibel untuk berbagai kegiatan organisasi
                                </CardDescription>
                            </CardHeader>
                            <CardContent>
                                <ul className="space-y-2 text-sm text-gray-600">
                                    <li>• Absensi berdasarkan kegiatan</li>
                                    <li>• Customizable per bidang/divisi</li>
                                    <li>• QR Code untuk check-in cepat</li>
                                    <li>• Laporan kehadiran real-time</li>
                                    <li>• Kontrol Admin/Pengurus</li>
                                </ul>
                            </CardContent>
                        </Card>
                    </div>
                </div>
            </section>

            {/* User Roles Section */}
            <section className="py-20 bg-gray-50">
                <div className="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                    <div className="text-center mb-16">
                        <h2 className="text-3xl font-bold text-gray-900 mb-4">
                            🎯 Tingkat Akses Pengguna
                        </h2>
                        <p className="text-lg text-gray-600 max-w-2xl mx-auto">
                            Sistem role-based yang disesuaikan dengan struktur organisasi HMI
                        </p>
                    </div>

                    <div className="grid md:grid-cols-3 gap-8">
                        <div className="bg-white p-6 rounded-xl shadow-sm border">
                            <div className="w-16 h-16 bg-red-100 rounded-full flex items-center justify-center mx-auto mb-4">
                                <span className="text-2xl">👑</span>
                            </div>
                            <h3 className="text-xl font-bold text-center text-red-800 mb-3">Administrator</h3>
                            <p className="text-gray-600 text-center mb-4">Kontrol penuh atas seluruh sistem</p>
                            <ul className="space-y-2 text-sm text-gray-600">
                                <li>• Verifikasi akun kader baru</li>
                                <li>• Assign NIK (Nomor Induk Kader)</li>
                                <li>• Kelola perpustakaan & peminjaman</li>
                                <li>• Atur kegiatan & absensi</li>
                                <li>• Reset password pengguna</li>
                            </ul>
                        </div>

                        <div className="bg-white p-6 rounded-xl shadow-sm border">
                            <div className="w-16 h-16 bg-blue-100 rounded-full flex items-center justify-center mx-auto mb-4">
                                <span className="text-2xl">⚖️</span>
                            </div>
                            <h3 className="text-xl font-bold text-center text-blue-800 mb-3">Pengurus</h3>
                            <p className="text-gray-600 text-center mb-4">Mengelola perpustakaan & kehadiran</p>
                            <ul className="space-y-2 text-sm text-gray-600">
                                <li>• Approve peminjaman buku</li>
                                <li>• Kelola koleksi perpustakaan</li>
                                <li>• Buat & kelola event absensi</li>
                                <li>• Lihat laporan kehadiran</li>
                                <li>• Atur durasi peminjaman</li>
                            </ul>
                        </div>

                        <div className="bg-white p-6 rounded-xl shadow-sm border">
                            <div className="w-16 h-16 bg-emerald-100 rounded-full flex items-center justify-center mx-auto mb-4">
                                <span className="text-2xl">🎓</span>
                            </div>
                            <h3 className="text-xl font-bold text-center text-emerald-800 mb-3">Kader</h3>
                            <p className="text-gray-600 text-center mb-4">Akses profil & layanan komisariat</p>
                            <ul className="space-y-2 text-sm text-gray-600">
                                <li>• Kelola profil pribadi</li>
                                <li>• Browse koleksi perpustakaan</li>
                                <li>• Request peminjaman buku</li>
                                <li>• Isi absensi kegiatan</li>
                                <li>• Lihat riwayat aktivitas</li>
                            </ul>
                        </div>
                    </div>
                </div>
            </section>

            {/* CTA Section */}
            <section className="py-20 bg-gradient-to-r from-emerald-600 to-blue-600">
                <div className="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
                    <h2 className="text-3xl font-bold text-white mb-4">
                        🚀 Bergabung dengan Sistem Informasi Kader
                    </h2>
                    <p className="text-xl text-emerald-100 mb-8 max-w-2xl mx-auto">
                        Daftarkan diri Anda untuk mengakses layanan digital HMI Hukum Brawijaya. 
                        Verifikasi akan dilakukan oleh Administrator setelah pendaftaran.
                    </p>
                    <div className="flex flex-col sm:flex-row gap-4 justify-center">
                        <Link href="/register">
                            <Button size="lg" className="bg-white text-emerald-600 hover:bg-emerald-50 px-8">
                                📋 Daftar Sekarang
                            </Button>
                        </Link>
                        <Link href="/login">
                            <Button size="lg" variant="outline" className="border-white text-white hover:bg-white hover:text-emerald-600 px-8">
                                🔑 Sudah Punya Akun?
                            </Button>
                        </Link>
                    </div>
                </div>
            </section>

            {/* Footer */}
            <footer className="bg-gray-900 text-white py-12">
                <div className="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                    <div className="grid md:grid-cols-3 gap-8">
                        <div>
                            <div className="flex items-center space-x-3 mb-4">
                                <div className="w-10 h-10 bg-emerald-600 rounded-lg flex items-center justify-center">
                                    <span className="text-white font-bold text-lg">H</span>
                                </div>
                                <div>
                                    <h3 className="font-bold">HMI Hukum Brawijaya</h3>
                                    <p className="text-sm text-gray-400">Cadre Information System</p>
                                </div>
                            </div>
                            <p className="text-gray-400 text-sm">
                                Sistem informasi terintegrasi untuk mendukung aktivitas dan pengembangan kader 
                                Himpunan Mahasiswa Islam Komisariat Hukum Brawijaya.
                            </p>
                        </div>
                        <div>
                            <h4 className="font-semibold mb-4">Kontak</h4>
                            <div className="space-y-2 text-sm text-gray-400">
                                <p>📍 Fakultas Hukum Universitas Brawijaya</p>
                                <p>📧 hmi.hukum.brawijaya@email.com</p>
                                <p>📱 +62 xxx-xxxx-xxxx</p>
                            </div>
                        </div>
                        <div>
                            <h4 className="font-semibold mb-4">Tentang HMI</h4>
                            <div className="space-y-2 text-sm text-gray-400">
                                <p>🕌 Organisasi mahasiswa Islam</p>
                                <p>🎓 Fokus pengembangan intelektual</p>
                                <p>🤝 Komisariat Hukum Brawijaya</p>
                            </div>
                        </div>
                    </div>
                    <div className="border-t border-gray-800 mt-12 pt-8 text-center text-sm text-gray-400">
                        <p>&copy; 2024 HMI Hukum Brawijaya. Dikembangkan untuk kemajuan organisasi dan kader.</p>
                    </div>
                </div>
            </footer>
        </div>
    );
}