import QuestionHandler from './components/QuestionHandler';
import Overview from './components/Overview';
import TestComponent from './components/TestComponent';
import NotFound from './components/NotFound';

export const routes = [
    {
        path: '/',
        component: QuestionHandler
    },
    {   
        path: '/overview',
        component: Overview

    },

    //App routes before this section//
    {
        path: '/test',
        component: TestComponent
    },
    {   
        path: '/404',
        component: NotFound 
    },  
    { 
        path: '*',
        redirect: '/404' 
    },  

];