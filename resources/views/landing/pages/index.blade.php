<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>TikTok Sentiment Analysis</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <style>
        :root {
            --tiktok-red: #FE2C55;
            --tiktok-blue: #25F4EE;
            --tiktok-black: #000000;
            --tiktok-white: #FFFFFF;
        }

        body {
            font-family: 'Inter', sans-serif;
            transition: background-color 0.3s, color 0.3s;
        }

        .dark {
            --bg-primary: #121212;
            --bg-secondary: #1e1e1e;
            --text-primary: #ffffff;
            --text-secondary: #b3b3b3;
        }

        .light {
            --bg-primary: #ffffff;
            --bg-secondary: #f8f8f8;
            --text-primary: #000000;
            --text-secondary: #666666;
        }

        .tiktok-gradient {
            background: linear-gradient(90deg, var(--tiktok-blue), var(--tiktok-red));
        }

        .tiktok-button {
            background: linear-gradient(90deg, var(--tiktok-blue), var(--tiktok-red));
            transition: transform 0.3s;
        }

        .tiktok-button:hover {
            transform: scale(1.05);
        }

        .toggle-checkbox:checked {
            right: 0;
            border-color: var(--tiktok-blue);
        }

        .toggle-checkbox:checked+.toggle-label {
            background: linear-gradient(90deg, var(--tiktok-blue), var(--tiktok-red));
        }

        .sentiment-result {
            transition: all 0.3s ease;
        }

        .loader {
            border-top-color: var(--tiktok-blue);
            border-right-color: var(--tiktok-red);
            animation: spin 1s linear infinite;
        }

        @keyframes spin {
            0% {
                transform: rotate(0deg);
            }

            100% {
                transform: rotate(360deg);
            }
        }

        .feature-card {
            transition: transform 0.3s, box-shadow 0.3s;
        }

        .feature-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 25px -5px rgba(0, 0, 0, 0.1), 0 10px 10px -5px rgba(0, 0, 0, 0.04);
        }
    </style>
</head>

<body class="light">
    <div class="min-h-screen flex flex-col" style="background-color: var(--bg-primary); color: var(--text-primary);">
        <!-- Navigation -->
        <nav class="py-4 px-6 md:px-12 flex justify-between items-center"
            style="background-color: var(--bg-secondary);">
            <div class="flex items-center space-x-2">
                <div class="h-8 w-8 rounded-full tiktok-gradient flex items-center justify-center">
                    <span class="text-white font-bold">SA</span>
                </div>
                <span class="font-bold text-xl">TikSentiment</span>
            </div>

            <div class="flex items-center space-x-6">
                <a href="#about" class="hidden md:block hover:text-gray-400 transition">About</a>
                <a href="#features" class="hidden md:block hover:text-gray-400 transition">Features</a>
                <a href="#demo" class="hidden md:block hover:text-gray-400 transition">Demo</a>

                <!-- Dark Mode Toggle -->
                <div class="flex items-center">
                    <span class="mr-2 text-sm">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24"
                            stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M12 3v1m0 16v1m9-9h-1M4 12H3m15.364 6.364l-.707-.707M6.343 6.343l-.707-.707m12.728 0l-.707.707M6.343 17.657l-.707.707M16 12a4 4 0 11-8 0 4 4 0 018 0z" />
                        </svg>
                    </span>
                    <div class="relative inline-block w-10 mr-2 align-middle select-none">
                        <input type="checkbox" id="toggle"
                            class="toggle-checkbox absolute block w-6 h-6 rounded-full bg-white border-4 appearance-none cursor-pointer" />
                        <label for="toggle"
                            class="toggle-label block overflow-hidden h-6 rounded-full bg-gray-300 cursor-pointer"></label>
                    </div>
                    <span class="text-sm">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24"
                            stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M20.354 15.354A9 9 0 018.646 3.646 9.003 9.003 0 0012 21a9.003 9.003 0 008.354-5.646z" />
                        </svg>
                    </span>
                </div>
            </div>
        </nav>

        <!-- Hero Section -->
        <section class="py-20 px-6 md:px-12 flex flex-col md:flex-row items-center">
            <div class="md:w-1/2 mb-10 md:mb-0">
                <h1 class="text-4xl md:text-5xl font-bold mb-6">Understand Your <span
                        class="tiktok-gradient text-transparent bg-clip-text">TikTok</span> Audience</h1>
                <p class="text-lg mb-8" style="color: var(--text-secondary);">Analyze the sentiment of TikTok comments
                    and content using our advanced lexicon algorithm. Get insights into how your audience feels about
                    your content.</p>
                <a href="#demo" class="tiktok-button text-white font-semibold py-3 px-8 rounded-full inline-block">Try
                    It Now</a>
            </div>
            <div class="md:w-1/2 flex justify-center">
                <svg class="w-full max-w-md" viewBox="0 0 500 400" xmlns="http://www.w3.org/2000/svg">
                    <rect x="100" y="50" width="300" height="300" rx="20" fill="#1e1e1e" />
                    <rect x="120" y="90" width="260" height="180" rx="10" fill="#000000" />
                    <circle cx="250" cy="180" r="50" fill="#FE2C55" />
                    <path d="M230 160 L280 180 L230 200 Z" fill="white" />
                    <rect x="140" y="290" width="100" height="10" rx="5" fill="#25F4EE" />
                    <rect x="140" y="310" width="220" height="10" rx="5" fill="#FE2C55" />
                    <rect x="140" y="330" width="180" height="10" rx="5" fill="#25F4EE" />
                    <circle cx="350" cy="80" r="15" fill="#FE2C55" />
                    <circle cx="390" cy="80" r="15" fill="#25F4EE" />
                </svg>
            </div>
        </section>

        <!-- About Section -->
        <section id="about" class="py-16 px-6 md:px-12" style="background-color: var(--bg-secondary);">
            <div class="max-w-6xl mx-auto">
                <h2 class="text-3xl font-bold mb-12 text-center">About <span
                        class="tiktok-gradient text-transparent bg-clip-text">TikSentiment</span></h2>
                <div class="grid md:grid-cols-3 gap-8">
                    <div class="feature-card p-6 rounded-xl" style="background-color: var(--bg-primary);">
                        <div class="h-12 w-12 rounded-full tiktok-gradient flex items-center justify-center mb-4">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-white" fill="none"
                                viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2" />
                            </svg>
                        </div>
                        <h3 class="text-xl font-semibold mb-3">Lexicon Algorithm</h3>
                        <p style="color: var(--text-secondary);">Our sentiment analysis uses a sophisticated
                            lexicon-based algorithm that understands context and nuance in social media language.</p>
                    </div>
                    <div class="feature-card p-6 rounded-xl" style="background-color: var(--bg-primary);">
                        <div class="h-12 w-12 rounded-full tiktok-gradient flex items-center justify-center mb-4">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-white" fill="none"
                                viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6" />
                            </svg>
                        </div>
                        <h3 class="text-xl font-semibold mb-3">Real-time Analysis</h3>
                        <p style="color: var(--text-secondary);">Get instant feedback on the emotional tone of your
                            TikTok content to help you adjust your strategy in real-time.</p>
                    </div>
                    <div class="feature-card p-6 rounded-xl" style="background-color: var(--bg-primary);">
                        <div class="h-12 w-12 rounded-full tiktok-gradient flex items-center justify-center mb-4">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-white" fill="none"
                                viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z" />
                            </svg>
                        </div>
                        <h3 class="text-xl font-semibold mb-3">Detailed Insights</h3>
                        <p style="color: var(--text-secondary);">Beyond basic positive/negative classification, get
                            detailed emotional insights including intensity and specific emotion categories.</p>
                    </div>
                </div>
            </div>
        </section>

        <!-- Features Section -->
        <section id="features" class="py-16 px-6 md:px-12">
            <div class="max-w-6xl mx-auto">
                <h2 class="text-3xl font-bold mb-12 text-center">Key <span
                        class="tiktok-gradient text-transparent bg-clip-text">Features</span></h2>

                <div class="flex flex-col md:flex-row items-center mb-16">
                    <div class="md:w-1/2 mb-8 md:mb-0 md:pr-8">
                        <h3 class="text-2xl font-semibold mb-4">Sentiment Classification</h3>
                        <p class="mb-4" style="color: var(--text-secondary);">Our algorithm classifies text into
                            positive, negative, or neutral sentiment with high accuracy. It understands TikTok-specific
                            language, slang, and emoji usage.</p>
                        <ul class="space-y-2">
                            <li class="flex items-center">
                                <svg class="h-5 w-5 mr-2 text-green-500" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M5 13l4 4L19 7"></path>
                                </svg>
                                <span>Contextual understanding of social media language</span>
                            </li>
                            <li class="flex items-center">
                                <svg class="h-5 w-5 mr-2 text-green-500" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M5 13l4 4L19 7"></path>
                                </svg>
                                <span>Emoji interpretation</span>
                            </li>
                            <li class="flex items-center">
                                <svg class="h-5 w-5 mr-2 text-green-500" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M5 13l4 4L19 7"></path>
                                </svg>
                                <span>Slang and internet language support</span>
                            </li>
                        </ul>
                    </div>
                    <div class="md:w-1/2">
                        <div class="rounded-xl overflow-hidden shadow-lg"
                            style="background-color: var(--bg-secondary);">
                            <div class="p-6">
                                <div class="flex items-center justify-between mb-4">
                                    <h4 class="font-semibold">Sentiment Score</h4>
                                    <div class="h-8 w-8 rounded-full tiktok-gradient flex items-center justify-center">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-white"
                                            fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                        </svg>
                                    </div>
                                </div>
                                <div class="mb-4 h-4 bg-gray-700 rounded-full overflow-hidden">
                                    <div class="h-full tiktok-gradient" style="width: 75%"></div>
                                </div>
                                <div class="flex justify-between text-sm">
                                    <span>Negative</span>
                                    <span>Neutral</span>
                                    <span>Positive</span>
                                </div>
                            </div>
                            <div class="p-6 border-t border-gray-700">
                                <div class="grid grid-cols-3 gap-4">
                                    <div class="text-center">
                                        <div class="text-2xl font-bold mb-1">75%</div>
                                        <div class="text-sm" style="color: var(--text-secondary);">Positive</div>
                                    </div>
                                    <div class="text-center">
                                        <div class="text-2xl font-bold mb-1">15%</div>
                                        <div class="text-sm" style="color: var(--text-secondary);">Neutral</div>
                                    </div>
                                    <div class="text-center">
                                        <div class="text-2xl font-bold mb-1">10%</div>
                                        <div class="text-sm" style="color: var(--text-secondary);">Negative</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="flex flex-col-reverse md:flex-row items-center">
                    <div class="md:w-1/2 md:pr-8">
                        <div class="rounded-xl overflow-hidden shadow-lg"
                            style="background-color: var(--bg-secondary);">
                            <div class="p-6">
                                <div class="flex items-center justify-between mb-4">
                                    <h4 class="font-semibold">Emotion Analysis</h4>
                                    <div class="h-8 w-8 rounded-full tiktok-gradient flex items-center justify-center">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-white"
                                            fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M14.828 14.828a4 4 0 01-5.656 0M9 10h.01M15 10h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                        </svg>
                                    </div>
                                </div>
                                <div class="space-y-3">
                                    <div>
                                        <div class="flex justify-between mb-1">
                                            <span>Joy</span>
                                            <span>65%</span>
                                        </div>
                                        <div class="h-2 bg-gray-700 rounded-full overflow-hidden">
                                            <div class="h-full bg-yellow-400" style="width: 65%"></div>
                                        </div>
                                    </div>
                                    <div>
                                        <div class="flex justify-between mb-1">
                                            <span>Excitement</span>
                                            <span>45%</span>
                                        </div>
                                        <div class="h-2 bg-gray-700 rounded-full overflow-hidden">
                                            <div class="h-full bg-pink-500" style="width: 45%"></div>
                                        </div>
                                    </div>
                                    <div>
                                        <div class="flex justify-between mb-1">
                                            <span>Surprise</span>
                                            <span>30%</span>
                                        </div>
                                        <div class="h-2 bg-gray-700 rounded-full overflow-hidden">
                                            <div class="h-full bg-purple-500" style="width: 30%"></div>
                                        </div>
                                    </div>
                                    <div>
                                        <div class="flex justify-between mb-1">
                                            <span>Concern</span>
                                            <span>10%</span>
                                        </div>
                                        <div class="h-2 bg-gray-700 rounded-full overflow-hidden">
                                            <div class="h-full bg-blue-500" style="width: 10%"></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="md:w-1/2 mb-8 md:mb-0">
                        <h3 class="text-2xl font-semibold mb-4">Emotion Detection</h3>
                        <p class="mb-4" style="color: var(--text-secondary);">Go beyond basic sentiment analysis
                            with detailed emotion detection. Understand if your audience is feeling joy, excitement,
                            surprise, concern, or other emotions.</p>
                        <ul class="space-y-2">
                            <li class="flex items-center">
                                <svg class="h-5 w-5 mr-2 text-green-500" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M5 13l4 4L19 7"></path>
                                </svg>
                                <span>8 primary emotion categories</span>
                            </li>
                            <li class="flex items-center">
                                <svg class="h-5 w-5 mr-2 text-green-500" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M5 13l4 4L19 7"></path>
                                </svg>
                                <span>Intensity scoring for each emotion</span>
                            </li>
                            <li class="flex items-center">
                                <svg class="h-5 w-5 mr-2 text-green-500" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M5 13l4 4L19 7"></path>
                                </svg>
                                <span>Trend analysis over time</span>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </section>

        <!-- Demo Section -->
        <section id="demo" class="py-16 px-6 md:px-12" style="background-color: var(--bg-secondary);">
            <div class="max-w-3xl mx-auto">
                <h2 class="text-3xl font-bold mb-6 text-center">Try <span
                        class="tiktok-gradient text-transparent bg-clip-text">Sentiment Analysis</span></h2>
                <p class="text-center mb-10" style="color: var(--text-secondary);">Enter a TikTok comment or caption
                    to analyze its sentiment using our lexicon algorithm.</p>

                <div class="rounded-xl p-6 shadow-lg mb-8" style="background-color: var(--bg-primary);">
                    <form id="sentiment-form" class="space-y-4">
                        <div>
                            <label for="text-input" class="block mb-2 font-medium">Enter text to analyze:</label>
                            <textarea id="text-input" rows="4"
                                class="w-full px-4 py-2 rounded-lg border focus:ring-2 focus:ring-blue-500 focus:border-transparent transition"
                                style="background-color: var(--bg-secondary); color: var(--text-primary); border-color: #333;"
                                placeholder="Type or paste TikTok comment/caption here..."></textarea>
                        </div>
                        <button type="submit"
                            class="tiktok-button text-white font-semibold py-3 px-6 rounded-full w-full">Analyze
                            Sentiment</button>
                    </form>
                </div>

                <div id="loading" class="hidden flex justify-center my-8">
                    <div class="loader h-12 w-12 rounded-full border-4 border-gray-300"></div>
                </div>

                <div id="result" class="hidden rounded-xl p-6 shadow-lg"
                    style="background-color: var(--bg-primary);">
                    <h3 class="text-xl font-semibold mb-4">Analysis Results</h3>

                    <div class="mb-6">
                        <div class="flex justify-between mb-2">
                            <span class="font-medium">Overall Sentiment:</span>
                            <span id="sentiment-label" class="font-semibold text-green-500">Positive</span>
                        </div>
                        <div class="h-2 bg-gray-700 rounded-full overflow-hidden">
                            <div id="sentiment-bar" class="h-full tiktok-gradient" style="width: 75%"></div>
                        </div>
                    </div>

                    <div class="grid grid-cols-3 gap-4 mb-6">
                        <div class="text-center p-3 rounded-lg" style="background-color: var(--bg-secondary);">
                            <div id="positive-score" class="text-2xl font-bold mb-1">75%</div>
                            <div class="text-sm" style="color: var(--text-secondary);">Positive</div>
                        </div>
                        <div class="text-center p-3 rounded-lg" style="background-color: var(--bg-secondary);">
                            <div id="neutral-score" class="text-2xl font-bold mb-1">15%</div>
                            <div class="text-sm" style="color: var(--text-secondary);">Neutral</div>
                        </div>
                        <div class="text-center p-3 rounded-lg" style="background-color: var(--bg-secondary);">
                            <div id="negative-score" class="text-2xl font-bold mb-1">10%</div>
                            <div class="text-sm" style="color: var(--text-secondary);">Negative</div>
                        </div>
                    </div>

                    <div>
                        <h4 class="font-medium mb-3">Key Words:</h4>
                        <div id="keywords" class="flex flex-wrap gap-2">
                            <span class="px-3 py-1 rounded-full text-sm font-medium"
                                style="background-color: rgba(37, 244, 238, 0.2);">amazing</span>
                            <span class="px-3 py-1 rounded-full text-sm font-medium"
                                style="background-color: rgba(37, 244, 238, 0.2);">love</span>
                            <span class="px-3 py-1 rounded-full text-sm font-medium"
                                style="background-color: rgba(37, 244, 238, 0.2);">great</span>
                            <span class="px-3 py-1 rounded-full text-sm font-medium"
                                style="background-color: rgba(254, 44, 85, 0.2);">issue</span>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- Footer -->
        <footer class="py-12 px-6 md:px-12 mt-auto" style="background-color: var(--bg-primary);">
            <div class="max-w-6xl mx-auto">
                <div class="flex flex-col md:flex-row justify-between items-center mb-8">
                    <div class="flex items-center space-x-2 mb-4 md:mb-0">
                        <div class="h-8 w-8 rounded-full tiktok-gradient flex items-center justify-center">
                            <span class="text-white font-bold">SA</span>
                        </div>
                        <span class="font-bold text-xl">TikSentiment</span>
                    </div>
                    <div class="flex space-x-6">
                        <a href="#" class="hover:text-gray-400 transition">
                            <svg class="h-6 w-6" fill="currentColor" viewBox="0 0 24 24">
                                <path
                                    d="M12 2.163c3.204 0 3.584.012 4.85.07 3.252.148 4.771 1.691 4.919 4.919.058 1.265.069 1.645.069 4.849 0 3.205-.012 3.584-.069 4.849-.149 3.225-1.664 4.771-4.919 4.919-1.266.058-1.644.07-4.85.07-3.204 0-3.584-.012-4.849-.07-3.26-.149-4.771-1.699-4.919-4.92-.058-1.265-.07-1.644-.07-4.849 0-3.204.013-3.583.07-4.849.149-3.227 1.664-4.771 4.919-4.919 1.266-.057 1.645-.069 4.849-.069zm0-2.163c-3.259 0-3.667.014-4.947.072-4.358.2-6.78 2.618-6.98 6.98-.059 1.281-.073 1.689-.073 4.948 0 3.259.014 3.668.072 4.948.2 4.358 2.618 6.78 6.98 6.98 1.281.058 1.689.072 4.948.072 3.259 0 3.668-.014 4.948-.072 4.354-.2 6.782-2.618 6.979-6.98.059-1.28.073-1.689.073-4.948 0-3.259-.014-3.667-.072-4.947-.196-4.354-2.617-6.78-6.979-6.98-1.281-.059-1.69-.073-4.949-.073zm0 5.838c-3.403 0-6.162 2.759-6.162 6.162s2.759 6.163 6.162 6.163 6.162-2.759 6.162-6.163c0-3.403-2.759-6.162-6.162-6.162zm0 10.162c-2.209 0-4-1.79-4-4 0-2.209 1.791-4 4-4s4 1.791 4 4c0 2.21-1.791 4-4 4zm6.406-11.845c-.796 0-1.441.645-1.441 1.44s.645 1.44 1.441 1.44c.795 0 1.439-.645 1.439-1.44s-.644-1.44-1.439-1.44z" />
                            </svg>
                        </a>
                        <a href="#" class="hover:text-gray-400 transition">
                            <svg class="h-6 w-6" fill="currentColor" viewBox="0 0 24 24">
                                <path
                                    d="M23.953 4.57a10 10 0 01-2.825.775 4.958 4.958 0 002.163-2.723c-.951.555-2.005.959-3.127 1.184a4.92 4.92 0 00-8.384 4.482C7.69 8.095 4.067 6.13 1.64 3.162a4.822 4.822 0 00-.666 2.475c0 1.71.87 3.213 2.188 4.096a4.904 4.904 0 01-2.228-.616v.06a4.923 4.923 0 003.946 4.827 4.996 4.996 0 01-2.212.085 4.936 4.936 0 004.604 3.417 9.867 9.867 0 01-6.102 2.105c-.39 0-.779-.023-1.17-.067a13.995 13.995 0 007.557 2.209c9.053 0 13.998-7.496 13.998-13.985 0-.21 0-.42-.015-.63A9.935 9.935 0 0024 4.59z" />
                            </svg>
                        </a>
                        <a href="#" class="hover:text-gray-400 transition">
                            <svg class="h-6 w-6" fill="currentColor" viewBox="0 0 24 24">
                                <path
                                    d="M12 0c-6.626 0-12 5.373-12 12 0 5.302 3.438 9.8 8.207 11.387.599.111.793-.261.793-.577v-2.234c-3.338.726-4.033-1.416-4.033-1.416-.546-1.387-1.333-1.756-1.333-1.756-1.089-.745.083-.729.083-.729 1.205.084 1.839 1.237 1.839 1.237 1.07 1.834 2.807 1.304 3.492.997.107-.775.418-1.305.762-1.604-2.665-.305-5.467-1.334-5.467-5.931 0-1.311.469-2.381 1.236-3.221-.124-.303-.535-1.524.117-3.176 0 0 1.008-.322 3.301 1.23.957-.266 1.983-.399 3.003-.404 1.02.005 2.047.138 3.006.404 2.291-1.552 3.297-1.23 3.297-1.23.653 1.653.242 2.874.118 3.176.77.84 1.235 1.911 1.235 3.221 0 4.609-2.807 5.624-5.479 5.921.43.372.823 1.102.823 2.222v3.293c0 .319.192.694.801.576 4.765-1.589 8.199-6.086 8.199-11.386 0-6.627-5.373-12-12-12z" />
                            </svg>
                        </a>
                    </div>
                </div>
                <div class="border-t border-gray-700 pt-8">
                    <div class="grid md:grid-cols-4 gap-8">
                        <div>
                            <h4 class="font-semibold mb-4">Product</h4>
                            <ul class="space-y-2" style="color: var(--text-secondary);">
                                <li><a href="#" class="hover:text-gray-400 transition">Features</a></li>
                                <li><a href="#" class="hover:text-gray-400 transition">Pricing</a></li>
                                <li><a href="#" class="hover:text-gray-400 transition">API</a></li>
                                <li><a href="#" class="hover:text-gray-400 transition">Documentation</a></li>
                            </ul>
                        </div>
                        <div>
                            <h4 class="font-semibold mb-4">Resources</h4>
                            <ul class="space-y-2" style="color: var(--text-secondary);">
                                <li><a href="#" class="hover:text-gray-400 transition">Blog</a></li>
                                <li><a href="#" class="hover:text-gray-400 transition">Guides</a></li>
                                <li><a href="#" class="hover:text-gray-400 transition">Support</a></li>
                                <li><a href="#" class="hover:text-gray-400 transition">Community</a></li>
                            </ul>
                        </div>
                        <div>
                            <h4 class="font-semibold mb-4">Company</h4>
                            <ul class="space-y-2" style="color: var(--text-secondary);">
                                <li><a href="#" class="hover:text-gray-400 transition">About</a></li>
                                <li><a href="#" class="hover:text-gray-400 transition">Careers</a></li>
                                <li><a href="#" class="hover:text-gray-400 transition">Contact</a></li>
                                <li><a href="#" class="hover:text-gray-400 transition">Partners</a></li>
                            </ul>
                        </div>
                        <div>
                            <h4 class="font-semibold mb-4">Legal</h4>
                            <ul class="space-y-2" style="color: var(--text-secondary);">
                                <li><a href="#" class="hover:text-gray-400 transition">Privacy</a></li>
                                <li><a href="#" class="hover:text-gray-400 transition">Terms</a></li>
                                <li><a href="#" class="hover:text-gray-400 transition">Security</a></li>
                                <li><a href="#" class="hover:text-gray-400 transition">Cookies</a></li>
                            </ul>
                        </div>
                    </div>
                    <div class="mt-8 text-center" style="color: var(--text-secondary);">
                        <p>&copy; 2023 TikSentiment. All rights reserved.</p>
                    </div>
                </div>
            </div>
        </footer>
    </div>

    <script>
        // Dark mode toggle functionality
        const toggle = document.getElementById('toggle');
        const body = document.body;

        // Check for saved theme preference or use preferred color scheme
        const savedTheme = localStorage.getItem('theme');
        if (savedTheme) {
            body.classList.remove('light', 'dark');
            body.classList.add(savedTheme);
            toggle.checked = savedTheme === 'dark';
        } else {
            const prefersDark = window.matchMedia('(prefers-color-scheme: dark)').matches;
            if (prefersDark) {
                body.classList.remove('light');
                body.classList.add('dark');
                toggle.checked = true;
            }
        }

        toggle.addEventListener('change', function() {
            if (this.checked) {
                body.classList.remove('light');
                body.classList.add('dark');
                localStorage.setItem('theme', 'dark');
            } else {
                body.classList.remove('dark');
                body.classList.add('light');
                localStorage.setItem('theme', 'light');
            }
        });

        // // Sentiment analysis form handling
        // const form = document.getElementById('sentiment-form');
        // const loading = document.getElementById('loading');
        // const result = document.getElementById('result');

        // form.addEventListener('submit', function(e) {
        //     e.preventDefault();

        //     const textInput = document.getElementById('text-input').value.trim();

        //     if (!textInput) {
        //         alert('Please enter some text to analyze.');
        //         return;
        //     }

        //     // Show loading indicator
        //     loading.classList.remove('hidden');
        //     result.classList.add('hidden');

        //     // Simulate API call with setTimeout
        //     setTimeout(function() {
        //         // Hide loading indicator
        //         loading.classList.add('hidden');

        //         // Process the text and determine sentiment
        //         // This is a simplified demo version that doesn't actually use a lexicon algorithm
        //         const analysis = analyzeSentiment(textInput);

        //         // Update the UI with results
        //         document.getElementById('sentiment-label').textContent = analysis.overall;
        //         document.getElementById('sentiment-label').className = 'font-semibold ' + getSentimentColor(
        //             analysis.overall);

        //         document.getElementById('sentiment-bar').style.width = analysis.positiveScore + '%';

        //         document.getElementById('positive-score').textContent = analysis.positiveScore + '%';
        //         document.getElementById('neutral-score').textContent = analysis.neutralScore + '%';
        //         document.getElementById('negative-score').textContent = analysis.negativeScore + '%';

        //         // Update keywords
        //         const keywordsContainer = document.getElementById('keywords');
        //         keywordsContainer.innerHTML = '';

        //         analysis.keywords.forEach(keyword => {
        //             const span = document.createElement('span');
        //             span.className = 'px-3 py-1 rounded-full text-sm font-medium';
        //             span.textContent = keyword.word;

        //             if (keyword.sentiment === 'positive') {
        //                 span.style.backgroundColor = 'rgba(37, 244, 238, 0.2)';
        //             } else if (keyword.sentiment === 'negative') {
        //                 span.style.backgroundColor = 'rgba(254, 44, 85, 0.2)';
        //             } else {
        //                 span.style.backgroundColor = 'rgba(150, 150, 150, 0.2)';
        //             }

        //             keywordsContainer.appendChild(span);
        //         });

        //         // Show results
        //         result.classList.remove('hidden');
        //     }, 1500);
        // });

        // // Simple sentiment analysis function (demo only)
        // function analyzeSentiment(text) {
        //     const positiveWords = ['good', 'great', 'awesome', 'amazing', 'love', 'excellent', 'perfect', 'beautiful',
        //         'best', 'happy', 'like', 'nice', 'fun', 'cool', 'fantastic'
        //     ];
        //     const negativeWords = ['bad', 'terrible', 'awful', 'horrible', 'hate', 'dislike', 'poor', 'worst', 'sad',
        //         'boring', 'ugly', 'stupid', 'annoying', 'disappointing', 'issue'
        //     ];

        //     const words = text.toLowerCase().match(/\b(\w+)\b/g) || [];

        //     let positiveCount = 0;
        //     let negativeCount = 0;

        //     const foundKeywords = [];

        //     words.forEach(word => {
        //         if (positiveWords.includes(word)) {
        //             positiveCount++;
        //             if (!foundKeywords.some(k => k.word === word)) {
        //                 foundKeywords.push({
        //                     word,
        //                     sentiment: 'positive'
        //                 });
        //             }
        //         }
        //         if (negativeWords.includes(word)) {
        //             negativeCount++;
        //             if (!foundKeywords.some(k => k.word === word)) {
        //                 foundKeywords.push({
        //                     word,
        //                     sentiment: 'negative'
        //                 });
        //             }
        //         }
        //     });

        //     // Calculate scores
        //     const total = words.length;
        //     const neutralCount = total - positiveCount - negativeCount;

        //     const positiveScore = Math.round((positiveCount / Math.max(1, total)) * 100);
        //     const negativeScore = Math.round((negativeCount / Math.max(1, total)) * 100);
        //     const neutralScore = 100 - positiveScore - negativeScore;

        //     // Determine overall sentiment
        //     let overall;
        //     if (positiveScore > negativeScore && positiveScore > neutralScore) {
        //         overall = 'Positive';
        //     } else if (negativeScore > positiveScore && negativeScore > neutralScore) {
        //         overall = 'Negative';
        //     } else {
        //         overall = 'Neutral';
        //     }

        //     // Limit keywords to 5
        //     const keywords = foundKeywords.slice(0, 5);

        //     // If we have fewer than 3 keywords, add some neutral ones
        //     if (keywords.length < 3) {
        //         const neutralWords = words.filter(w => !positiveWords.includes(w) && !negativeWords.includes(w) && w
        //             .length > 3);
        //         for (let i = 0; i < Math.min(3 - keywords.length, neutralWords.length); i++) {
        //             if (!keywords.some(k => k.word === neutralWords[i])) {
        //                 keywords.push({
        //                     word: neutralWords[i],
        //                     sentiment: 'neutral'
        //                 });
        //             }
        //         }
        //     }

        //     return {
        //         overall,
        //         positiveScore,
        //         negativeScore,
        //         neutralScore,
        //         keywords
        //     };
        // }

        // function getSentimentColor(sentiment) {
        //     switch (sentiment) {
        //         case 'Positive':
        //             return 'text-green-500';
        //         case 'Negative':
        //             return 'text-red-500';
        //         default:
        //             return 'text-yellow-500';
        //     }
        // }

        // Smooth scrolling for anchor links
        document.querySelectorAll('a[href^="#"]').forEach(anchor => {
            anchor.addEventListener('click', function(e) {
                e.preventDefault();

                const targetId = this.getAttribute('href');
                const targetElement = document.querySelector(targetId);

                if (targetElement) {
                    window.scrollTo({
                        top: targetElement.offsetTop - 80,
                        behavior: 'smooth'
                    });
                }
            });
        });
    </script>
    <script>
        (function() {
            function c() {
                var b = a.contentDocument || a.contentWindow.document;
                if (b) {
                    var d = b.createElement('script');
                    d.innerHTML =
                        "window.__CF$cv$params={r:'94cd433194da9c86',t:'MTc0OTQzNjgwOC4wMDAwMDA='};var a=document.createElement('script');a.nonce='';a.src='/cdn-cgi/challenge-platform/scripts/jsd/main.js';document.getElementsByTagName('head')[0].appendChild(a);";
                    b.getElementsByTagName('head')[0].appendChild(d)
                }
            }
            if (document.body) {
                var a = document.createElement('iframe');
                a.height = 1;
                a.width = 1;
                a.style.position = 'absolute';
                a.style.top = 0;
                a.style.left = 0;
                a.style.border = 'none';
                a.style.visibility = 'hidden';
                document.body.appendChild(a);
                if ('loading' !== document.readyState) c();
                else if (window.addEventListener) document.addEventListener('DOMContentLoaded', c);
                else {
                    var e = document.onreadystatechange || function() {};
                    document.onreadystatechange = function(b) {
                        e(b);
                        'loading' !== document.readyState && (document.onreadystatechange = e, c())
                    }
                }
            }
        })();
    </script>

    <script>
        const form = document.getElementById('sentiment-form');
        const loading = document.getElementById('loading');
        const result = document.getElementById('result');

        form.addEventListener('submit', async function(e) {
            e.preventDefault();

            const textInput = document.getElementById('text-input').value.trim();

            if (!textInput) {
                alert('Please enter some text to analyze.');
                return;
            }

            // Show loading indicator
            loading.classList.remove('hidden');
            result.classList.add('hidden');

            // Kirim ke backend Laravel
            try {
                const response = await fetch('/landing/predict', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'Accept': 'application/json',
                        // Jika pakai CSRF token Laravel:
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute(
                            'content')
                    },
                    body: JSON.stringify({
                        statement: textInput
                    })
                });

                const data = await response.json();

                loading.classList.add('hidden');

                if (!response.ok) {
                    alert(data.message || 'Terjadi kesalahan. Coba lagi.');
                    return;
                }

                // Tampilkan hasil dari API Laravel
                // Label
                const label = data.label.charAt(0).toUpperCase() + data.label.slice(1);
                document.getElementById('sentiment-label').textContent = label;
                document.getElementById('sentiment-label').className =
                    'font-semibold ' + getSentimentColor(label);

                // Bar confidence (pakai confidence, 0-1 dikali 100)
                document.getElementById('sentiment-bar').style.width = (data.confidence * 100) + '%';

                // Score per kategori (positive/neutral/negative)
                // Asumsi: label dari API hanya satu (positive/neutral/negative)
                document.getElementById('positive-score').textContent =
                    data.label === 'positive' ? Math.round(data.confidence * 100) + '%' : '0%';
                document.getElementById('neutral-score').textContent =
                    data.label === 'neutral' ? Math.round(data.confidence * 100) + '%' : '0%';
                document.getElementById('negative-score').textContent =
                    data.label === 'negative' ? Math.round(data.confidence * 100) + '%' : '0%';

                // Update keywords (dari hasil cleaned, ambil kata-kata unik, tampilkan 3-5 kata)
                const keywordsContainer = document.getElementById('keywords');
                keywordsContainer.innerHTML = '';
                if (data.cleaned) {
                    // Ambil 5 kata unik dari hasil cleaned
                    let words = data.cleaned.split(' ');
                    let uniqWords = [...new Set(words.filter(w => w.length > 3))].slice(0, 5);
                    uniqWords.forEach(word => {
                        const span = document.createElement('span');
                        span.className = 'px-3 py-1 rounded-full text-sm font-medium';
                        span.textContent = word;
                        // Pewarnaan sesuai label utama
                        if (data.label === 'positive') {
                            span.style.backgroundColor = 'rgba(37, 244, 238, 0.2)';
                        } else if (data.label === 'negative') {
                            span.style.backgroundColor = 'rgba(254, 44, 85, 0.2)';
                        } else {
                            span.style.backgroundColor = 'rgba(150, 150, 150, 0.2)';
                        }
                        keywordsContainer.appendChild(span);
                    });
                }

                // Tampilkan result
                result.classList.remove('hidden');

            } catch (err) {
                loading.classList.add('hidden');
                alert('Terjadi kesalahan jaringan.');
            }
        });

        function getSentimentColor(sentiment) {
            switch (sentiment.toLowerCase()) {
                case 'positive':
                    return 'text-green-500';
                case 'negative':
                    return 'text-red-500';
                default:
                    return 'text-yellow-500';
            }
        }
    </script>
</body>

</html>
