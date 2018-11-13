import QuestionHandler from './components/QuestionHandler';
import TestComponent from './components/TestComponent';
import NotFound from './components/NotFound';

export const routes = [
    {
        path: '/',
        component: QuestionHandler
    },
    {
        path: '/test',
        component: TestComponent
    },
    {   path: '/404',
        component: NotFound 
    },  
    { 
        path: '*',
        redirect: '/404' 
    },  

];