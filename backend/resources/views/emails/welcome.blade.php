<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Welcome</title>
    <!-- Tailwind CSS CDN for styling preview -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="bg-slate-100 font-sans antialiased m-0 p-0">

    <!-- Email Wrapper -->
    <table width="100%" cellpadding="0" cellspacing="0" role="presentation" class="bg-slate-100 py-12">
        <tr>
            <td align="center">

                <!-- Main Card Container -->
                <table width="100%" cellpadding="0" cellspacing="0" role="presentation"
                    class="max-w-lg bg-white rounded-2xl shadow-sm border border-slate-200 overflow-hidden mx-auto">

                    <!-- Header Banner -->
                    <tr>
                        <td class="bg-indigo-600 px-8 py-6 text-center">
                            <span class="text-white text-xl font-bold tracking-tight">🎉 Welcome Aboard!</span>
                        </td>
                    </tr>

                    <!-- Body Content -->
                    <tr>
                        <td class="px-8 py-10 text-slate-700">
                            <h1 class="text-2xl font-bold text-slate-900 mb-4">
                                Hello, {{ $user->name }}!
                            </h1>

                            <p class="text-base leading-relaxed mb-4">
                                Thank you for registering with us. We are absolutely thrilled to have you join our
                                community.
                            </p>

                            <p class="text-base leading-relaxed mb-8">
                                Get ready to explore everything we have to offer. If you ever have any questions, feel
                                free to reach out.
                            </p>

                            <!-- Call to Action Button (Optional but recommended) -->
                            <table cellpadding="0" cellspacing="0" role="presentation" class="mb-8">
                                <tr>
                                    <td>
                                        <a href="#"
                                            class="inline-block bg-indigo-600 hover:bg-indigo-700 text-white font-medium text-base px-6 py-3 rounded-xl transition-colors no-underline">
                                            Get Started
                                        </a>
                                    </td>
                                </tr>
                            </table>

                            <div class="border-t border-slate-100 pt-6">
                                <p class="text-base text-slate-600 m-0">
                                    Warm regards,<br>
                                    <strong class="text-slate-900">The Team</strong>
                                </p>
                            </div>
                        </td>
                    </tr>

                    <!-- Footer -->
                </table>
                <table width="100%" cellpadding="0" cellspacing="0" role="presentation"
                    class="max-w-lg mx-auto text-center mt-6">
                    <tr>
                        <td class="text-xs text-slate-400">
                            &copy; 2026 Your Company. All rights reserved.<br>
                            <a href="#" class="text-slate-500 underline">Unsubscribe</a> if you no longer wish to
                            receive these emails.
                        </td>
                    </tr>
                </table>

            </td>
        </tr>
    </table>

</body>

</html>