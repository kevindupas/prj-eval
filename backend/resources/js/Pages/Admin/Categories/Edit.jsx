/* eslint-disable no-undef */
/* eslint-disable react/prop-types */
import React from 'react';
import { useForm, router } from '@inertiajs/react';
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout';

function List({ auth, category }) {
    const {
        data, setData, processing, progress, errors,
    } = useForm({
        name:        category.name,
        image:       null,
        description: category.description,
    });

    const handleSubmit = (event) => {
        event.preventDefault();
        router.post(route('categories.update', { category: category.id }), {
            _method: 'put',
            ...data,
        });
    };

    return (
        <AuthenticatedLayout
            user={auth.user}
            header={(
                <h2 className="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">Formulaire création catégorie</h2>
            )}
        >

            <div className="py-12">
                <div className="max-w-7xl mx-auto sm:px-6 lg:px-8">
                    <ul className="grid grid-cols-1 gap-6 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-1 bg-white p-6 rounded-lg">
                        <form onSubmit={handleSubmit}>
                            <div className="space-y-12">
                                <div className="border-b border-gray-900/10 pb-12">
                                    <div className="grid grid-cols-1 gap-x-6 gap-y-8 sm:grid-cols-6">
                                        <div className="sm:col-span-4">
                                            <label htmlFor="name" className="block text-sm font-medium leading-6 text-gray-900">
                                                Nom de la catégorie
                                                <div className="mt-2">
                                                    <div className="mt-2">
                                                        <input
                                                            type="text"
                                                            name="name"
                                                            id="name"
                                                            value={data.name}
                                                            onChange={(e) => setData('name', e.target.value)}
                                                            autoComplete="name"
                                                            className="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6"
                                                        />
                                                        {errors.name && <p className="text-red-500 text-xs italic">{errors.name}</p>}
                                                    </div>
                                                </div>
                                            </label>
                                        </div>

                                        <div className="col-span-full">
                                            <label htmlFor="description" className="block text-sm font-medium leading-6 text-gray-900">
                                                Description
                                            </label>
                                            <div className="mt-2">
                                                <textarea
                                                    id="description"
                                                    name="description"
                                                    value={data.description}
                                                    onChange={(e) => setData('description', e.target.value)}
                                                    rows={3}
                                                    className="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6"
                                                />
                                                {errors.description && <p className="text-red-500 text-xs italic">{errors.description}</p>}
                                            </div>
                                            <p className="mt-3 text-sm leading-6 text-gray-600">Write a few sentences about yourself.</p>
                                        </div>

                                        <div className="col-span-full">
                                            <label htmlFor="image" className="block text-sm font-medium leading-6 text-gray-900">
                                                Image
                                                <div className="mt-2 flex items-center gap-x-3">
                                                    <input
                                                        type="file"
                                                        onChange={(e) => setData(
                                                            'image',
                                                            e.target.files !== null ? e.target.files[0] : null,
                                                        )}
                                                        className="rounded-md bg-white px-2.5 py-1.5 text-sm font-semibold text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 hover:bg-gray-50"
                                                    />
                                                    {errors.image && <p className="text-red-500 text-xs italic">{errors.image}</p>}
                                                    {progress && (
                                                        <progress value={progress.percentage} max="100">
                                                            {progress.percentage}
                                                            %
                                                        </progress>
                                                    )}
                                                </div>
                                            </label>
                                        </div>

                                    </div>
                                </div>

                            </div>

                            <div className="mt-6 flex items-center justify-end gap-x-6">
                                <button type="button" className="text-sm font-semibold leading-6 text-gray-900">
                                    Cancel
                                </button>
                                <button
                                    type="submit"
                                    disabled={processing}
                                    className="rounded-md bg-indigo-600 px-3 py-2 text-sm font-semibold text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600"
                                >
                                    Save
                                </button>
                            </div>
                        </form>
                    </ul>
                </div>
            </div>
        </AuthenticatedLayout>
    );
}

export default List;
