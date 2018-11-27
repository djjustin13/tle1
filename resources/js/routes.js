import QuestionHandler from './components/QuestionHandler';
import Overview from './components/Overview';
import TestComponent from './components/TestComponent';
import NotFound from './components/NotFound';
import ChallengeCar from './components/challenges/ChallengeCar';
import ChallengeMeat from './components/challenges/ChallengeMeat';
import ChallengeShower from './components/challenges/ChallengeShower';
import ChallengeSmoking from './components/challenges/ChallengeSmoking';

export const routes = [
    {
        path: '/',
        component: QuestionHandler
    },
    {   
        path: '/overview',
        component: Overview
    },
    {
        path: '/challengecar',
        component: ChallengeCar
    },
    {
        path: '/challengemeat',
        component: ChallengeMeat
    },
    {
        path: '/challengeshower',
        component: ChallengeShower
    },
    {
        path: '/challengesmoking',
        component: ChallengeSmoking
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