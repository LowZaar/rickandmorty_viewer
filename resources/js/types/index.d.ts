import CharacterGender from '@/enums/CharacterGender';
import CharacterStatus from '@/enums/CharacterStatus';
import type { PageProps } from '@inertiajs/core';
import type { LucideIcon } from 'lucide-vue-next';
import type { Config } from 'ziggy-js';

export interface Auth {
    user: User;
}

export interface BreadcrumbItem {
    title: string;
    href: string;
}

export interface NavItem {
    title: string;
    href: string;
    icon?: LucideIcon;
    isActive?: boolean;
}

export interface SharedData extends PageProps {
    name: string;
    quote: { message: string; author: string };
    auth: Auth;
    ziggy: Config & { location: string };
}

export interface User {
    id: number;
    name: string;
    email: string;
    avatar?: string;
    email_verified_at: string | null;
    created_at: string;
    updated_at: string;
}

export interface Location {
    id: number;
    name: string;
    type: string;
    dimension: string;
    residents: string[];
    url: string;
    created: Date;
}

export interface Character {
    id: number;
    name: string;
    species: string;
    type: string;
    status: CharacterStatus;
    gender: CharacterGender;
    origin: CharacterLocation;
    location: CharacterLocation;
    image: string;
    episode: string[];
    url: string;
    created: Date;
}

export interface CharacterLocation {
    name: string;
    url: string;
}

export interface ApiPagination {
    count: number;
    pages: number;
    next: string | null;
    prev: string | null;
}

export interface innerPaginationItem {
    url: string;
    label: string;
    active: boolean;
}

export type BreadcrumbItemType = BreadcrumbItem;
