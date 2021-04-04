import AllKnights from './components/AllKnights.vue';
import FightRing from './components/FightRing.vue';

export const routes = [
    {
        name: 'home',
        path: '/',
        component: AllKnights
    },
    {
        name: "fight",
        path: "/begin-fight",
        component: FightRing
    }
];
