import Home from './components/Home.vue';
import ProfileMain from './components/profile/Main.vue';
import ProfileList from './components/profile/List.vue';
import DaftarMain from './components/dokter/DaftarMain.vue';
import DaftarList from './components/dokter/DaftarList.vue';
import JadwalMain from './components/dokter/JadwalMain.vue';
import JadwalList from './components/dokter/JadwalList.vue';
import LayananMain from './components/layanan/Main.vue';
import LayananList from './components/layanan/List.vue';
import InformasiMain from './components/informasi/Main.vue';
import InformasiList from './components/informasi/List.vue';
import BukuTamu from './components/BukuTamu.vue';


export const routes = [
    {
        path: '/',
        component: Home
    },
    {
        path: '/profile',
        component: ProfileMain,
        children: [
            {
                path: '/',
                component: ProfileList
            }
        ]
    },
    {
        path: '/daftar-dokter',
        component: DaftarMain,
        children: [
            {
                path: '/',
                component: DaftarList
            }
        ]
    },
    {
        path: '/jadwal-dokter',
        component: JadwalMain,
        children: [
            {
                path: '/',
                component: JadwalList
            }
        ]
    },
    {
        path: '/layanan',
        component: LayananMain,
        children: [
            {
                path: '/',
                component: LayananList
            }
        ]
    },
    {
        path: '/informasi',
        component: InformasiMain,
        children: [
            {
                path: '/',
                component: InformasiList
            }
        ]
    },
    {
        path: '/buku-tamu',
        component: BukuTamu
    }
];