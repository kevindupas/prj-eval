/* eslint-disable react/prop-types */
import React from 'react';
import { Head, Link } from '@inertiajs/react';
import {
    PencilIcon, TrashIcon,
} from '@heroicons/react/24/solid';
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout';

function List({ auth, categories }) {
    return (
        <AuthenticatedLayout
            user={auth.user}
            header={(
                <div className="flex justify-between justify-center items-center">
                    <h2 className="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">Catégories</h2>
                    <Link href={route('categories.create')} className="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                        Ajouter une catégorie
                    </Link>
                </div>
            )}
        >

            <div className="py-12">
                <div className="max-w-7xl mx-auto sm:px-6 lg:px-8">
                    <ul className="grid grid-cols-1 gap-6 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4">
                        {categories.map((item) => (
                            <li
                                key={item.id}
                                className="col-span-1 flex flex-col divide-y divide-gray-200 rounded-lg bg-white text-center shadow"
                            >
                                <div className="flex flex-1 flex-col p-8">
                                    <img className="mx-auto h-32 w-32 flex-shrink-0 rounded-md" src={item.image} alt="" />
                                    <h3 className="mt-6 text-sm font-medium text-gray-900">{item.name}</h3>
                                </div>
                                <div>
                                    <div className="-mt-px flex divide-x divide-gray-200">
                                        <div className="flex w-0 flex-1">
                                            <Link
                                                href={route('categories.edit', { category: item.id })}
                                                className="relative inline-flex w-0 flex-1 items-center justify-center gap-x-3 rounded-br-lg border border-transparent py-4 text-sm font-semibold text-gray-900"
                                            >
                                                <PencilIcon className="h-5 w-5 text-gray-400" aria-hidden="true" />
                                                Editer
                                            </Link>
                                        </div>
                                        <div className="-ml-px flex w-0 flex-1">
                                            <Link
                                                href={route('categories.destroy', { category: item.id })}
                                                method="delete"
                                                as="button"
                                                className="relative inline-flex w-0 flex-1 items-center justify-center gap-x-3 rounded-br-lg border border-transparent py-4 text-sm font-semibold text-gray-900"
                                            >
                                                <TrashIcon className="h-5 w-5 text-gray-400" aria-hidden="true" />
                                                Supprimer
                                            </Link>
                                        </div>
                                    </div>
                                </div>
                            </li>
                        ))}
                    </ul>
                </div>
            </div>
        </AuthenticatedLayout>
    );
}

export default List;
