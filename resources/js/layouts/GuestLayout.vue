<script setup lang="ts">
import { Link, usePage } from '@inertiajs/vue3';
import { Menu } from 'lucide-vue-next';
import AppLogo from '@/components/AppLogo.vue';
import AppLogoIcon from '@/components/AppLogoIcon.vue';
import { Button } from '@/components/ui/button';
import { buttonVariants } from '@/components/ui/button';
import {
    Sheet,
    SheetContent,
    SheetHeader,
    SheetTitle,
    SheetTrigger,
} from '@/components/ui/sheet';
import { index, login, register } from '@/routes';

const canRegister = usePage().props.canRegister as boolean;
</script>

<template>
    <div class="flex min-h-screen w-full flex-col">
        <div class="border-b border-sidebar-border/80">
            <div class="mx-auto flex h-16 items-center px-4 md:max-w-7xl">
                <Link :href="index()" class="flex items-center gap-x-2">
                    <AppLogo />
                </Link>

                <div class="ml-auto hidden items-center space-x-2 lg:flex">
                    <Link :href="login()" :class="buttonVariants({ variant: 'ghost' })">Log in</Link>

                    <Link v-if="canRegister" :href="register()" :class="buttonVariants()">Register</Link>
                </div>

                <!-- Mobile Menu -->
                <div class="ml-auto lg:hidden">
                    <Sheet>
                        <SheetTrigger :as-child="true">
                            <Button variant="ghost" size="icon" class="h-10 w-10">
                                <Menu class="h-6 w-6" />
                            </Button>
                        </SheetTrigger>

                        <SheetContent side="right" class="w-75 p-6">
                            <SheetTitle class="sr-only">Navigation menu</SheetTitle>

                            <SheetHeader class="flex justify-start text-left">
                                <AppLogoIcon class="size-6 fill-current text-black dark:text-white" />
                            </SheetHeader>

                            <div class="flex h-full flex-1 flex-col justify-between space-y-4 py-6">
                                <nav class="-mx-3 space-y-1">
                                    <Link
                                        :href="login()"
                                        class="flex items-center gap-x-3 rounded-lg px-3 py-2 text-sm font-medium hover:bg-accent"
                                    >
                                        Log in
                                    </Link>

                                    <Link
                                        v-if="canRegister"
                                        :href="register()"
                                        class="flex items-center gap-x-3 rounded-lg px-3 py-2 text-sm font-medium hover:bg-accent"
                                    >
                                        Register
                                    </Link>
                                </nav>
                            </div>
                        </SheetContent>
                    </Sheet>
                </div>
            </div>
        </div>

        <main class="mx-auto flex h-full w-full max-w-7xl flex-1 flex-col gap-4 rounded-xl">
            <slot />
        </main>
    </div>
</template>
