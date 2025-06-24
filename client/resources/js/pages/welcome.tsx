import { type SharedData } from '@/types';
import { Head, Link, usePage } from '@inertiajs/react';

export default function Welcome() {
    const { auth } = usePage<SharedData>().props;

    return (
        <>
            <h1 className='font-bold text-7xl text-teal-600 text-center'>Welcome</h1>
            
        </>
    );
}
