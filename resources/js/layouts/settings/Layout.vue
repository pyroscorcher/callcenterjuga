<script setup lang="ts">
import { Link } from '@inertiajs/vue3';
import Heading from '@/components/Heading.vue';
import { Button } from '@/components/ui/button';
import { Separator } from '@/components/ui/separator';
import { useCurrentUrl } from '@/composables/useCurrentUrl';
import { toUrl } from '@/lib/utils';
import type { NavItem } from '@/types';

// 1. Impor ikon yang ingin digunakan (biasanya menggunakan lucide-vue-next)
import { User, Lock, Palette, Shield } from 'lucide-vue-next';

const { isCurrentOrParentUrl } = useCurrentUrl();

// 2. Definisikan array sidebarNavItems di sini
const sidebarNavItems: NavItem[] = [
    {
        title: 'Profile',
        href: '/settings/profile', // Sesuaikan dengan route Laravel Anda
        icon: User,
    },
    {
        title: 'Security',
        href: '/settings/security', // Sesuaikan dengan route Laravel Anda
        icon: Lock,
    },
    {
        title: 'Appearance',
        href: '/settings/appearance', // Sesuaikan dengan route Laravel Anda
        icon: Palette,
    },
];
</script>

<template>
    <div class="px-4 py-6">
        <Heading
            title="Settings"
            description="Manage your profile and account settings"
        />

        <div class="flex flex-col lg:flex-row lg:space-x-12">
            <aside class="w-full max-w-xl lg:w-48">
                <nav
                    class="flex flex-col space-y-1 space-x-0"
                    aria-label="Settings"
                >
                    <Button
                        v-for="item in sidebarNavItems"
                        :key="toUrl(item.href)"
                        variant="ghost"
                        :class="[
                            'w-full justify-start',
                            { 'bg-muted': isCurrentOrParentUrl(item.href) },
                        ]"
                        as-child
                    >
                        <Link :href="item.href">
                            <component :is="item.icon" class="h-4 w-4 mr-2" />
                            {{ item.title }}
                        </Link>
                    </Button>
                </nav>
            </aside>

            <Separator class="my-6 lg:hidden" />

            <div class="flex-1 md:max-w-2xl">
                <section class="max-w-xl space-y-12">
                    <slot />
                </section>
            </div>
        </div>
    </div>
</template>