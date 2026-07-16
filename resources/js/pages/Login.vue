<script setup>
import { useForm, Link } from '@inertiajs/vue3';

const form = useForm({
    email: '',
    password: '',
    remember: false,
});

const submit = () => {
    form.post(route('login'), {
        onFinish: () => form.reset('password'),
    });
};
</script>

<template>
    <div class="min-h-screen bg-gray-100 flex items-center justify-center p-4 sm:p-6 lg:p-8">
        
        <div class="bg-white w-full max-w-5xl rounded-2xl shadow-xl flex overflow-hidden">
            
            <div class="hidden md:flex md:w-1/2 bg-blue-50 items-center justify-center p-12">
                <img 
                    src="public/logositaba.png" 
                    alt="Login Illustration" 
                    class="max-w-full h-auto object-contain"
                >
            </div>

            <div class="w-full md:w-1/2 p-8 sm:p-12">
                <div class="max-w-md mx-auto">
                    
                    <h2 class="text-3xl font-bold text-gray-900 mb-2">Welcome Back</h2>
                    <p class="text-gray-500 text-sm mb-8">Please login to your account</p>

                    <form @submit.prevent="submit" class="space-y-5">
                        
                        <div>
                            <label for="email" class="block text-sm font-medium text-gray-700 mb-1">Email Address</label>
                            <input 
                                id="email" 
                                type="email" 
                                v-model="form.email" 
                                required 
                                class="w-full px-4 py-3 rounded-lg border border-gray-300 focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors outline-none"
                                placeholder="Enter your email"
                            >
                            <div v-if="form.errors.email" class="text-red-500 text-xs mt-1">{{ form.errors.email }}</div>
                        </div>

                        <div>
                            <label for="password" class="block text-sm font-medium text-gray-700 mb-1">Password</label>
                            <input 
                                id="password" 
                                type="password" 
                                v-model="form.password" 
                                required 
                                class="w-full px-4 py-3 rounded-lg border border-gray-300 focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors outline-none"
                                placeholder="Enter your password"
                            >
                            <div v-if="form.errors.password" class="text-red-500 text-xs mt-1">{{ form.errors.password }}</div>
                        </div>

                        <div class="flex items-center justify-between">
                            <label class="flex items-center">
                                <input 
                                    type="checkbox" 
                                    v-model="form.remember" 
                                    class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500"
                                >
                                <span class="ml-2 text-sm text-gray-600">Remember Me</span>
                            </label>

                            <Link 
                                v-if="route().has('password.request')" 
                                :href="route('password.request')" 
                                class="text-sm font-medium text-blue-600 hover:text-blue-500"
                            >
                                Forgot Password?
                            </Link>
                        </div>

                        <button 
                            type="submit" 
                            :disabled="form.processing"
                            class="w-full bg-gray-900 text-white font-semibold py-3 rounded-lg hover:bg-gray-800 transition-colors duration-200 flex justify-center items-center mt-6 disabled:opacity-50"
                        >
                            <span v-if="form.processing">Logging in...</span>
                            <span v-else>Login</span>
                        </button>
                    </form>

                    <div class="mt-8 flex items-center justify-center">
                        <div class="border-t border-gray-300 flex-grow"></div>
                        <span class="px-3 text-sm text-gray-500 bg-white">Or</span>
                        <div class="border-t border-gray-300 flex-grow"></div>
                    </div>

                    <div class="mt-6 space-y-3">
                        <button class="w-full flex items-center justify-center px-4 py-2.5 border border-gray-300 rounded-lg text-gray-700 bg-white hover:bg-gray-50 transition-colors duration-200">
                            <svg class="w-5 h-5 mr-3" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path d="M22.56 12.25c0-.78-.07-1.53-.2-2.25H12v4.26h5.92c-.26 1.37-1.04 2.53-2.21 3.31v2.77h3.57c2.08-1.92 3.28-4.74 3.28-8.09z" fill="#4285F4"/><path d="M12 23c2.97 0 5.46-.98 7.28-2.66l-3.57-2.77c-.98.66-2.23 1.06-3.71 1.06-2.86 0-5.29-1.93-6.16-4.53H2.18v2.84C3.99 20.53 7.7 23 12 23z" fill="#34A853"/><path d="M5.84 14.09c-.22-.66-.35-1.36-.35-2.09s.13-1.43.35-2.09V7.07H2.18C1.43 8.55 1 10.22 1 12s.43 3.45 1.18 4.93l2.85-2.22.81-.62z" fill="#FBBC05"/><path d="M12 5.38c1.62 0 3.06.56 4.21 1.64l3.15-3.15C17.45 2.09 14.97 1 12 1 7.7 1 3.99 3.47 2.18 7.07l3.66 2.84c.87-2.6 3.3-4.53 6.16-4.53z" fill="#EA4335"/></svg>
                            Sign in with Google
                        </button>
                        
                        <button class="w-full flex items-center justify-center px-4 py-2.5 border border-gray-300 rounded-lg text-gray-700 bg-white hover:bg-gray-50 transition-colors duration-200">
                            <svg class="w-5 h-5 mr-3" fill="#1877F2" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path d="M24 12.073c0-6.627-5.373-12-12-12s-12 5.373-12 12c0 5.99 4.388 10.954 10.125 11.854v-8.385H7.078v-3.469h3.047V9.43c0-3.007 1.792-4.669 4.533-4.669 1.312 0 2.686.235 2.686.235v2.953H15.83c-1.491 0-1.956.925-1.956 1.874v2.25h3.328l-.532 3.469h-2.796v8.385C19.612 23.027 24 18.062 24 12.073z"/></svg>
                            Sign in with Facebook
                        </button>
                    </div>

                </div>
            </div>
        </div>
    </div>
</template>