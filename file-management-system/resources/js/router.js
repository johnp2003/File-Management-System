import {createWebHistory, createRouter} from "vue-router";
import home from './pages/Home.vue';
import folderCreate from './pages/folder/Create.vue';
import folderEdit from './pages/folder/Edit.vue';
import fileList from './pages/folder/FileList.vue';
import fileSearch from './pages/file/Search.vue';

const routes = [
   {
    path: "/",
    name: 'Home',
    component: home,
    meta: {title: "File Manager"}
   },
   {
    path: "/folders/create",
    name: 'FolderCreate',
    component: folderCreate,
    meta: {title: "Folder Create"}
   },
   {
    path: "/folders/:id",
    name: 'FileList',
    component: fileList,
    meta: {title: "File List"}
   },
   {
    path: "/folders/edit/:id",
    name: 'FolderEdit',
    component: folderEdit,
    meta: {title: "Folder Edit"}
   },
   {
    path: "/file/search/",
    name: 'FileSearch',
    component: fileSearch,
    meta: {title: "File Search"}
   }
]


const router = createRouter({
    history: createWebHistory(),
    routes
});

export default router;