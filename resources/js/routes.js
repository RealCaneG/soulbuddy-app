import CreateArticle from "./components/CreateArticle";
import ChatComponent from "./components/ChatComponent";
import CreateCounsellingRequest from "./components/CreateCounsellingRequest";
import Counselling from "./pages/Counselling";
import Article from "./pages/Article";
import CreateSecret from "./components/CreateSecret";
import Secret from "./pages/Secret";
import Pricing from "./pages/Pricing";

export const routes = [
    { path: '/home', component: Article, name: 'Articles'},
    { path: '/home/articles', component: Article, name: 'Article'},
    { path: '/home/articles/new', component: CreateArticle, name: 'CreateArticle'},
    { path: '/home/secrets', component: Secret, name: 'Secret'},
    { path: '/home/secret/new', component: CreateSecret, name: 'CreateSecret'},
    { path: '/home/top_up', component: Pricing, name: 'Pricing'},
    { path: '/home/message', component: ChatComponent, name: 'Message'},
    { path: '/home/counselling', component: Counselling, name:'Counselling'},
    { path: '/home/counselling/new', component: CreateCounsellingRequest, name:'CreateCounsellingRequest'}
];
