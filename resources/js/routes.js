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
import Login from './components/auth/Login.vue';
import DashboardMain from './admins/MainAdmin.vue';
import DashboardList from './admins/dashboard/List.vue';
import AdminProfile from './admins/profile/List.vue';
import ProfileNew from './admins/profile/New.vue';
import ProfileView from './admins/profile/View.vue';
import ProfileEdit from './admins/profile/Edit.vue';
import PeranKategori from './admins/perandankategori/List.vue';
import KategoriEdit from './admins/perandankategori/Editkategori.vue';
import KategoriNew from './admins/perandankategori/Newkategori.vue';
import PeranEdit from './admins/perandankategori/Editperan.vue';
import PeranNew from './admins/perandankategori/Newperan.vue';
import AdminPost from './admins/post/List.vue';

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
    },
    {
        path: '/login',
        component: Login
    },
    {
        path: '/admin',
        component: DashboardMain,
        meta: {
            requiresAuth: true
        },
        children: [
            {
                path: '/',
                component: DashboardList
            },
            {
                path: 'profile',
                component: AdminProfile
            },
            {
                path: 'profile/new',
                component: ProfileNew
            },
            {
                path: 'profile/:slug',
                component: ProfileView
            },
            {
                path: 'profile/edit/:slug',
                component: ProfileEdit
            },
            {
                path: 'peran-dan-kategori',
                component: PeranKategori
            },
            {
                path: 'kategori/new',
                component: KategoriNew
            },
            {
                path: 'kategoris/edit/:slug',
                component: KategoriEdit
            },
            {
                path: 'peran/new',
                component: PeranNew
            },
            {
                path: 'perans/edit/:slug',
                component: PeranEdit
            },
            {
                path: 'post',
                component: AdminPost
            }
        ]
    }
];