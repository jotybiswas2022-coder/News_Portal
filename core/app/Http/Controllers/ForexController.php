<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Contact;
use App\Models\Partner;
use App\Models\Product;
use App\Models\SourceCode;

class ForexController extends Controller
{
    // Products data
    private function getProducts()
    {
        return [
            'dark-algo' => [
                'name' => 'Dark Algo',
                'tagline' => 'EURUSD & GBPUSD Mastery',
                'description' => 'Precision scalping for major pairs. Dark Algo is an advanced Expert Advisor designed specifically for EURUSD and GBPUSD, utilizing a proprietary Stochastic indicator for high-accuracy signal detection.',
                'indicator' => 'Stochastic Indicator',
                'pairs' => ['EURUSD', 'GBPUSD'],
                'reviews' => 150,
                'liveSignalYears' => 3,
                'available' => true,
                'plans' => [
                    ['id' => 1, 'name' => 'Dark Algo', 'price' => 399, 'licenses' => 5, 'vps' => '1 Month', 'features' => ['5 Flexible Licenses', 'MT4 & MT5', 'Free Updates', 'Free 1 Month VPS', 'Stochastic Indicator', 'All Set Files', 'Installation Guide', 'Lifetime Membership']],
                    ['id' => 2, 'name' => 'Dark Algo+', 'price' => 599, 'licenses' => 10, 'vps' => '3 Months', 'features' => ['10 Flexible Licenses', 'MT4 & MT5', 'Free Updates', 'Free 3 Months VPS', 'Stochastic Indicator', 'All Set Files', 'Installation Guide', 'Lifetime Membership'], 'popular' => true],
                ],
                'heroTagline' => 'Precision Scalping at Your Fingertips',
                'heroDescription' => 'Dark Algo is engineered for traders who demand accuracy. Using advanced Stochastic algorithms, it identifies optimal entry and exit points with remarkable precision.',
                'features' => [
                    ['tagline' => 'Advanced Signal Detection', 'title' => 'Optimize Your Trades Accuracy', 'text' => 'The Stochastic indicator is a powerful tool for identifying overbought and oversold conditions. Dark Algo takes this further with advanced filtering algorithms that reduce false signals and improve trade quality.'],
                    ['tagline' => 'Insightful Performance Analysis', 'title' => 'Understanding Potential with Dark Algo', 'text' => 'Extensive backtesting across multiple market conditions demonstrates consistent performance. Our algorithms are optimized for both trending and ranging markets.'],
                    ['tagline' => 'Real Trading, Real Results', 'title' => 'Dark Algo 3-Year Conservative Signal', 'text' => 'Three years of live trading data shows steady growth with controlled drawdown. Our conservative approach prioritizes capital preservation while capturing profitable opportunities.'],
                ],
            ],
            'dark-nova' => [
                'name' => 'Dark Nova',
                'tagline' => 'Multi-Currency Scalping Power',
                'description' => 'Dark Nova is a versatile Expert Advisor capable of trading multiple currency pairs simultaneously. Built for advanced traders who want diversified exposure.',
                'indicator' => 'RSI & MACD Combo',
                'pairs' => ['EURUSD', 'GBPUSD', 'USDJPY'],
                'reviews' => 120,
                'liveSignalYears' => 2,
                'available' => true,
                'plans' => [
                    ['id' => 3, 'name' => 'Dark Nova', 'price' => 449, 'licenses' => 5, 'vps' => '1 Month', 'features' => ['5 Flexible Licenses', 'MT4 & MT5', 'Free Updates', 'Free 1 Month VPS', 'RSI & MACD Indicator', 'All Set Files', 'Installation Guide', 'Lifetime Membership']],
                    ['id' => 4, 'name' => 'Dark Nova+', 'price' => 649, 'licenses' => 10, 'vps' => '3 Months', 'features' => ['10 Flexible Licenses', 'MT4 & MT5', 'Free Updates', 'Free 3 Months VPS', 'RSI & MACD Indicator', 'All Set Files', 'Installation Guide', 'Lifetime Membership'], 'popular' => true],
                ],
                'heroTagline' => 'Multi-Currency Trading Power',
                'heroDescription' => 'Dark Nova leverages the combined power of RSI and MACD indicators to identify high-probability trading opportunities across multiple currency pairs.',
                'features' => [
                    ['tagline' => 'Dual Indicator Strategy', 'title' => 'RSI + MACD Synergy', 'text' => 'By combining RSI for momentum detection and MACD for trend confirmation, Dark Nova achieves superior signal accuracy.'],
                    ['tagline' => 'Multi-Pair Support', 'title' => 'Trade Multiple Markets', 'text' => 'Dark Nova simultaneously monitors and trades EURUSD, GBPUSD, and USDJPY, diversifying risk across multiple currency pairs.'],
                    ['tagline' => 'Risk Management', 'title' => 'Advanced Protection Features', 'text' => 'Built-in trailing stops, dynamic position sizing, and maximum drawdown limits protect your trading capital.'],
                ],
            ],
            'dark-kronos' => [
                'name' => 'Dark Kronos',
                'tagline' => 'Advanced Grid Trading System',
                'description' => 'Dark Kronos implements a sophisticated grid trading strategy enhanced with machine learning algorithms for optimal performance in volatile markets.',
                'indicator' => 'Grid + ML Algorithm',
                'pairs' => ['EURUSD', 'GBPUSD', 'USDJPY', 'XAUUSD'],
                'reviews' => 95,
                'liveSignalYears' => 2,
                'available' => true,
                'plans' => [
                    ['id' => 5, 'name' => 'Dark Kronos', 'price' => 499, 'licenses' => 5, 'vps' => '1 Month', 'features' => ['5 Flexible Licenses', 'MT4 & MT5', 'Free Updates', 'Free 1 Month VPS', 'Grid+ML Algorithm', 'All Set Files', 'Installation Guide', 'Lifetime Membership']],
                    ['id' => 6, 'name' => 'Dark Kronos+', 'price' => 699, 'licenses' => 10, 'vps' => '3 Months', 'features' => ['10 Flexible Licenses', 'MT4 & MT5', 'Free Updates', 'Free 3 Months VPS', 'Grid+ML Algorithm', 'All Set Files', 'Installation Guide', 'Lifetime Membership'], 'popular' => true],
                ],
                'heroTagline' => 'Intelligent Grid Trading',
                'heroDescription' => 'Dark Kronos combines traditional grid trading with machine learning to adapt to changing market conditions automatically.',
                'features' => [
                    ['tagline' => 'Smart Grid Technology', 'title' => 'Adaptive Grid Parameters', 'text' => 'Grid spacing and position sizes adjust automatically based on market volatility and trend strength.'],
                    ['tagline' => 'Machine Learning', 'title' => 'Self-Optimizing Algorithm', 'text' => 'The ML engine continuously learns from market data to optimize entry points and grid parameters.'],
                    ['tagline' => 'Volatility Protection', 'title' => 'Market Crash Protection', 'text' => 'Advanced circuit breakers and drawdown limiters protect against extreme market movements.'],
                ],
            ],
            'dark-titan' => [
                'name' => 'Dark Titan',
                'tagline' => 'High-Frequency Scalping EA',
                'description' => 'Dark Titan is designed for high-frequency scalping with ultra-low latency execution. Perfect for traders who want rapid-fire precision entries.',
                'indicator' => 'Price Action + ATR',
                'pairs' => ['EURUSD'],
                'reviews' => 80,
                'liveSignalYears' => 1.5,
                'available' => true,
                'plans' => [
                    ['id' => 7, 'name' => 'Dark Titan', 'price' => 349, 'licenses' => 5, 'vps' => '1 Month', 'features' => ['5 Flexible Licenses', 'MT4 & MT5', 'Free Updates', 'Free 1 Month VPS', 'Price Action + ATR', 'All Set Files', 'Installation Guide', 'Lifetime Membership']],
                    ['id' => 8, 'name' => 'Dark Titan+', 'price' => 549, 'licenses' => 10, 'vps' => '3 Months', 'features' => ['10 Flexible Licenses', 'MT4 & MT5', 'Free Updates', 'Free 3 Months VPS', 'Price Action + ATR', 'All Set Files', 'Installation Guide', 'Lifetime Membership'], 'popular' => true],
                ],
                'heroTagline' => 'Ultra-Fast Scalping Engine',
                'heroDescription' => 'Dark Titan executes trades in milliseconds, capturing tiny price movements for consistent, compounding returns.',
                'features' => [
                    ['tagline' => 'Low Latency', 'title' => 'Microsecond Execution', 'text' => 'Optimized for low-latency execution with direct market access and minimal slippage.'],
                    ['tagline' => 'Price Action Focus', 'title' => 'Pure Price Action Strategy', 'text' => 'No lagging indicators — Dark Titan reads raw price action and ATR for split-second decisions.'],
                    ['tagline' => 'Scalping Precision', 'title' => 'Tight Spread Trading', 'text' => 'Specifically optimized for ECN brokers with tight spreads for maximum scalping efficiency.'],
                ],
            ],
            'dark-gold' => [
                'name' => 'Dark Gold',
                'tagline' => 'Gold & XAUUSD Trading',
                'description' => 'Dark Gold is specifically engineered for XAUUSD (Gold) trading. Master the gold market with algorithms designed for precious metals volatility.',
                'indicator' => 'Gold Volatility Index',
                'pairs' => ['XAUUSD'],
                'reviews' => 110,
                'liveSignalYears' => 2.5,
                'available' => true,
                'plans' => [
                    ['id' => 9, 'name' => 'Dark Gold', 'price' => 449, 'licenses' => 5, 'vps' => '1 Month', 'features' => ['5 Flexible Licenses', 'MT4 & MT5', 'Free Updates', 'Free 1 Month VPS', 'Gold Volatility Index', 'All Set Files', 'Installation Guide', 'Lifetime Membership']],
                    ['id' => 10, 'name' => 'Dark Gold+', 'price' => 649, 'licenses' => 10, 'vps' => '3 Months', 'features' => ['10 Flexible Licenses', 'MT4 & MT5', 'Free Updates', 'Free 3 Months VPS', 'Gold Volatility Index', 'All Set Files', 'Installation Guide', 'Lifetime Membership'], 'popular' => true],
                ],
                'heroTagline' => 'Master the Gold Market',
                'heroDescription' => 'Dark Gold is purpose-built for XAUUSD trading, understanding the unique volatility patterns and price dynamics of the precious metals market.',
                'features' => [
                    ['tagline' => 'Gold-Specific Algorithm', 'title' => 'Purpose-Built for XAUUSD', 'text' => 'Unlike generic EAs, Dark Gold is specifically designed for gold\'s unique trading characteristics and volatility patterns.'],
                    ['tagline' => 'Volatility Analysis', 'title' => 'Smart Volatility Detection', 'text' => 'Advanced algorithms detect shifts in gold market volatility and adjust trading parameters accordingly.'],
                    ['tagline' => 'News Resistance', 'title' => 'Economic Event Protection', 'text' => 'Built-in economic calendar integration reduces exposure during high-impact news events for gold.'],
                ],
            ],
        ];
    }

    /**
     * Filter out empty/incomplete plans (must have a name and price).
     */
    private function filterValidPlans(?array $plans): array
    {
        if (empty($plans)) return [];
        
        return collect($plans)->filter(function ($plan) {
            return !empty($plan['name']) && !empty($plan['price']) && $plan['price'] > 0;
        })->values()->all();
    }

    // Bundles data
    private function getBundles()
    {
        return [
            [
                'id' => 1,
                'name' => 'Starter Bundle',
                'price' => 268.00,
                'period' => 'One Time',
                'products' => ['Dark Titan', 'Dark Gold'],
                'licenses' => '5+5 Licenses',
                'features' => ['Dark Titan + Dark Gold', '5+5 Licenses', 'Free Updates', 'Free 1M VPS', 'Dark Inversion Indicators'],
                'popular' => false,
                'available' => true,
            ],
            [
                'id' => 2,
                'name' => 'Premium Bundle',
                'price' => 790.00,
                'period' => 'One Time',
                'products' => ['Dark Algo', 'Dark Nova'],
                'licenses' => '5+5 Licenses',
                'features' => ['Dark Algo + Dark Nova', '5+5 Licenses', 'Free Updates', 'Free 3M VPS', 'All Set Files', 'Lifetime Member'],
                'popular' => true,
                'available' => true,
            ],
            [
                'id' => 3,
                'name' => 'Advanced Bundle',
                'price' => 1690.00,
                'period' => 'One Time',
                'products' => ['Dark Algo', 'Dark Nova', 'Dark Kronos'],
                'licenses' => '5+5+5 Licenses',
                'features' => ['Dark Algo + Dark Nova + Dark Kronos', '5+5+5 Licenses', 'Free Updates', 'Free 1M VPS', 'All Set Files', 'Lifetime Member'],
                'popular' => false,
                'available' => true,
            ],
        ];
    }

    // Reviews data
    private function getReviews()
    {
        return [
            ['id' => 1, 'date' => '2026-01-29', 'rating' => 5, 'verified' => true, 'text' => 'Clean scalper that does exactly what it promises. Been using Dark Algo for 3 months and consistently profitable.', 'reviewer' => 'Marco Scherer', 'source' => 'mql5 community', 'sourceUrl' => '#'],
            ['id' => 2, 'date' => '2026-01-15', 'rating' => 5, 'verified' => true, 'text' => 'Outstanding performance on GBPUSD. The drawdown control is impressive compared to other EAs I\'ve tried.', 'reviewer' => 'James Wilson', 'source' => 'mql5 community', 'sourceUrl' => '#'],
            ['id' => 3, 'date' => '2025-12-20', 'rating' => 5, 'verified' => true, 'text' => 'Best investment I\'ve made for my trading career. The support team is also very responsive and helpful.', 'reviewer' => 'Alex Chen', 'source' => 'mql5 community', 'sourceUrl' => '#'],
            ['id' => 4, 'date' => '2025-12-10', 'rating' => 4, 'verified' => true, 'text' => 'Solid EA with good risk management. Would recommend to both beginners and experienced traders.', 'reviewer' => 'Sarah Mitchell', 'source' => 'mql5 community', 'sourceUrl' => '#'],
            ['id' => 5, 'date' => '2025-11-28', 'rating' => 5, 'verified' => true, 'text' => 'The backtest results matched live trading performance almost exactly. Transparency is top-notch.', 'reviewer' => 'David Park', 'source' => 'mql5 community', 'sourceUrl' => '#'],
            ['id' => 6, 'date' => '2025-11-15', 'rating' => 5, 'verified' => true, 'text' => 'Running Dark Nova on 3 pairs simultaneously. Excellent diversification tool for my portfolio.', 'reviewer' => 'Michael Torres', 'source' => 'mql5 community', 'sourceUrl' => '#'],
            ['id' => 7, 'date' => '2025-10-30', 'rating' => 5, 'verified' => true, 'text' => 'Customer support helped me optimize the settings for my broker. Very impressed with the service.', 'reviewer' => 'Ryan O\'Brien', 'source' => 'mql5 community', 'sourceUrl' => '#'],
            ['id' => 8, 'date' => '2025-10-12', 'rating' => 5, 'verified' => true, 'text' => 'The grid system on Kronos is brilliant. Handles volatile markets much better than traditional grid EAs.', 'reviewer' => 'Emma Liu', 'source' => 'mql5 community', 'sourceUrl' => '#'],
        ];
    }

    // FAQ data
    private function getFaq()
    {
        return [
            ['q' => 'Is it a one-time payment?', 'a' => 'Yes! All our Expert Advisors are available for a one-time payment. No subscription fees, no hidden charges. You get lifetime access with free updates.'],
            ['q' => 'My EA isn\'t opening orders, what should I do?', 'a' => 'First, check if your broker allows automated trading. Ensure the EA is properly installed on MT4/MT5 and AutoTrading is enabled. Check our knowledgebase for detailed troubleshooting guides or contact our support team.'],
            ['q' => 'How many members use your EAs?', 'a' => 'We have over 1 million traders worldwide who trust our solutions. Our community continues to grow as more traders discover the power of our Expert Advisors.'],
            ['q' => 'Which broker do you recommend?', 'a' => 'We recommend ECN brokers with tight spreads and fast execution. Popular choices include IC Markets, Pepperstone, and FXTM. Check our broker settings guide for detailed recommendations.'],
            ['q' => 'Which VPS do you recommend?', 'a' => 'We recommend using a reliable VPS provider with low latency to your broker\'s servers. Our EAs come with free VPS options depending on your purchase plan.'],
            ['q' => 'Is there a free trial available?', 'a' => 'Yes! We offer free Expert Advisors that you can download and test. Check our verified MyFxbook track records for live performance data.'],
            ['q' => 'Can the EA be used with FIFO brokers?', 'a' => 'Yes, our EAs are fully compatible with FIFO (First In, First Out) brokers. The algorithms are designed to comply with FIFO regulations.'],
            ['q' => 'There is no TP & SL on my trades, why?', 'a' => 'Some of our strategies use dynamic trailing stops and advanced exit algorithms instead of fixed TP/SL. This allows for maximum profit capture. Check your EA settings or contact support for details.'],
            ['q' => 'Should I trade during holidays?', 'a' => 'We recommend avoiding trading during major holidays when market liquidity is low. Our EAs have built-in holiday calendars to automatically reduce exposure during low-liquidity periods.'],
            ['q' => 'How does the license work?', 'a' => 'Each license allows installation on one trading account. Depending on your plan, you get between 5-10 licenses. Additional licenses can be purchased separately.'],
            ['q' => 'My broker leverage is limited to 1:25. Would it be good?', 'a' => 'Yes, our EAs work well with lower leverage. The algorithms are designed to manage risk effectively regardless of your broker\'s leverage limits.'],
            ['q' => 'Is there a minimum deposit for EAs?', 'a' => 'We recommend a minimum deposit of $200-$500 depending on the EA and trading strategy. This ensures proper risk management and optimal performance.'],
        ];
    }

    // Knowledgebase data
    private function getKbArticles()
    {
        return [
            ['title' => 'Getting Started with Your First EA', 'category' => 'Getting Started', 'date' => '2026-01-15', 'content' => 'Welcome to SMART BINARY ZONE! This guide will walk you through the process of setting up your first Expert Advisor. From installation to configuration, we cover everything you need to know to start automated trading successfully.'],
            ['title' => 'How to Install EAs on MT4', 'category' => 'Installation Guide', 'date' => '2026-01-10', 'content' => 'Installing Expert Advisors on MetaTrader 4 is straightforward. Download your EA files, place them in the Experts folder, and refresh your Navigator panel. Detailed step-by-step instructions with screenshots included.'],
            ['title' => 'How to Install EAs on MT5', 'category' => 'Installation Guide', 'date' => '2026-01-08', 'content' => 'MetaTrader 5 installation process differs slightly from MT4. Learn how to properly install and configure your EAs on the MT5 platform for optimal performance.'],
            ['title' => 'Common EA Issues and Solutions', 'category' => 'Troubleshooting', 'date' => '2025-12-20', 'content' => 'Encountering issues with your EA? This comprehensive guide covers the most common problems traders face, including connection issues, order placement problems, and performance concerns.'],
            ['title' => 'Optimizing EA Settings for Maximum Profit', 'category' => 'Troubleshooting', 'date' => '2025-12-15', 'content' => 'Learn how to fine-tune your EA settings for different market conditions. Discover the optimal parameters for trend, range, and volatile markets.'],
            ['title' => 'Best Brokers for Automated Trading', 'category' => 'Broker Settings', 'date' => '2025-12-01', 'content' => 'Not all brokers are created equal for automated trading. We review the best brokers for EAs based on execution speed, spreads, and compatibility.'],
            ['title' => 'VPS Setup Guide for 24/7 Trading', 'category' => 'Installation Guide', 'date' => '2025-11-25', 'content' => 'Running your EAs on a VPS ensures 24/7 operation without interruptions. Step-by-step guide to setting up your VPS with your Expert Advisors.'],
            ['title' => 'Understanding Your License Key', 'category' => 'License & Account', 'date' => '2025-11-20', 'content' => 'Everything you need to know about EA license keys: how to activate, transfer between accounts, and troubleshoot activation issues.'],
            ['title' => 'Risk Management Best Practices', 'category' => 'Getting Started', 'date' => '2025-11-15', 'content' => 'Protect your trading capital with these essential risk management strategies. Learn about position sizing, maximum drawdown limits, and portfolio diversification.'],
            ['title' => 'Broker Settings for Dark EAs', 'category' => 'Broker Settings', 'date' => '2025-11-10', 'content' => 'Specific broker configuration recommendations for our Dark series EAs. Optimize your broker settings for the best performance with Dark Algo, Nova, Kronos, and more.'],
            ['title' => 'Account Management Dashboard Guide', 'category' => 'License & Account', 'date' => '2025-11-05', 'content' => 'Learn how to use your account dashboard to manage licenses, view download history, and track your EA performance.'],
            ['title' => 'Advanced Trading Strategies with Multiple EAs', 'category' => 'Getting Started', 'date' => '2025-10-28', 'content' => 'Combine multiple Expert Advisors for diversified trading. Learn how to run Dark Algo, Dark Nova, and Dark Kronos simultaneously without conflicts.'],
        ];
    }

    // Home page
    public function home()
    {
        $products = $this->getProducts();
        $bundles = $this->getBundles();
        $reviews = $this->getReviews();
        $faq = $this->getFaq();
        $features = [
            ['icon' => 'sliders', 'title' => 'High Customization', 'desc' => 'Adjust every parameter to match your trading style and risk tolerance.'],
            ['icon' => 'trending-up', 'title' => 'Market Resilience', 'desc' => 'Proven performance across various market conditions — trending, ranging, and volatile.'],
            ['icon' => 'cpu', 'title' => 'Innovative Technology', 'desc' => 'Built with cutting-edge algorithms including machine learning and advanced statistical models.'],
            ['icon' => 'eye', 'title' => 'Proven Transparency', 'desc' => 'Verified Myfxbook & MQL5 track-records with 99.90% backtest precision.'],
            ['icon' => 'headphones', 'title' => 'Direct Support', 'desc' => 'Get direct support from our team of experienced traders and developers.'],
            ['icon' => 'mouse-pointer', 'title' => 'User-Friendly Interface', 'desc' => 'Easy to install and configure, even for beginners. Comprehensive documentation included.'],
        ];
        $trustMetrics = [
            ['icon' => 'award', 'title' => 'Decade of Expertise', 'text' => 'Trusted by Over a Million Traders', 'sub' => '10+ years, 1M+ downloads, 4,136+ verified reviews'],
            ['icon' => 'check-circle', 'title' => 'No False Promises, Just Results', 'text' => 'Verified Myfxbook & MQL5 Track-records', 'sub' => '99.90% backtest precision, real account results'],
            ['icon' => 'globe', 'title' => 'Chosen by Traders Worldwide', 'text' => 'Explore Our Global Footprint', 'sub' => '120+ countries, mql5.com statistics'],
        ];
        return view('frontend.forex.home', compact('products', 'bundles', 'reviews', 'faq', 'features', 'trustMetrics'));
    }

    // Product page
    public function product($slug)
    {
        $products = $this->getProducts();
        $allProducts = $products;
        $product = $products[$slug] ?? null;
        if (!$product) abort(404);
        
        // Try to load matching DB product images (match by slug prefix, e.g. 'dark-algo' → 'dark-algo-5')
        $dbProduct = Product::where('slug', 'LIKE', $slug . '%')->first();
        if ($dbProduct) {
            $product['db_image'] = $dbProduct->image;
            $product['db_feature_images'] = [
                $dbProduct->feature_image_1,
                $dbProduct->feature_image_2,
                $dbProduct->feature_image_3,
            ];
        } else {
            $product['db_image'] = null;
            $product['db_feature_images'] = [null, null, null];
        }
        
        // Filter out empty/incomplete plans
        $product['plans'] = $this->filterValidPlans($product['plans'] ?? null);
        
        $reviews = $this->getReviews();
        $faq = $this->getFaq();
        return view('frontend.forex.product', compact('product', 'slug', 'reviews', 'faq', 'allProducts'));
    }

    // Products listing (dynamic from DB)
    public function products()
    {
        $products = Product::where('available', true)->orderBy('name')->paginate(12);
        return view('frontend.forex.products', compact('products'));
    }

    // Product detail (dynamic from DB)
    public function productDetail($slug)
    {
        $product = Product::where('slug', $slug)->where('available', true)->firstOrFail();
        
        // Filter out empty/incomplete plans from DB
        if ($product->plans) {
            $product->plans = $this->filterValidPlans($product->plans);
        }
        
        $faq = $this->getFaq();
        return view('frontend.forex.product-detail', compact('product', 'slug', 'faq'));
    }

    // Source codes listing (dynamic from DB)
    public function sourceCodes()
    {
        $sourceCodes = SourceCode::where('available', true)->orderBy('name')->paginate(12);
        return view('frontend.forex.source-codes', compact('sourceCodes'));
    }

    // Source code detail (dynamic from DB)
    public function sourceCodeDetail($slug)
    {
        $sourceCode = SourceCode::where('slug', $slug)->where('available', true)->firstOrFail();
        return view('frontend.forex.source-code-detail', compact('sourceCode'));
    }

    // Partnership - show page
    public function partnership()
    {
        return view('frontend.forex.partnership');
    }

    // Partnership - view my applications
    public function myPartnership(Request $request)
    {
        $query = Partner::where('email', auth()->user()->email);

        // Apply status filter if provided
        if ($request->filled('status')) {
            $status = $request->status;
            if (in_array($status, ['pending', 'approved', 'rejected'])) {
                $query->where('status', $status);
            }
        }

        $applications = $query->orderBy('created_at', 'desc')
            ->paginate(10)
            ->withQueryString();

        return view('frontend.forex.my-partnership', compact('applications'));
    }

    // Partnership - submit form
    public function partnerSubmit(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:100',
            'email' => 'required|email|max:100',
            'website' => 'nullable|string|max:255',
            'message' => 'nullable|string|max:5000',
        ]);

        Partner::create([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'website' => $validated['website'] ?? null,
            'message' => $validated['message'] ?? null,
            'status' => 'pending',
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Application submitted successfully! We will contact you within 24 hours.',
        ]);
    }

    // Contact us — show page
    public function contactUs()
    {
        return view('frontend.forex.contact-us');
    }

    // Contact us — submit form
    public function contactSubmit(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:100',
            'email' => 'required|email|max:100',
            'subject' => 'nullable|string|max:255',
            'message' => 'required|string|max:5000',
        ]);

        Contact::create($validated);

        return response()->json([
            'success' => true,
            'message' => 'Thank you! Your message has been sent successfully. We\'ll get back to you soon.',
        ]);
    }

    // Cart
    public function cart()
    {
        $products = $this->getProducts();
        return view('frontend.forex.cart', compact('products'));
    }

    // Payment Details
    public function paymentDetails()
    {
        return view('frontend.forex.payment-details');
    }

    // Knowledgebase
    public function knowledgebase()
    {
        $articles = $this->getKbArticles();
        $categories = array_unique(array_column($articles, 'category'));
        return view('frontend.forex.knowledgebase', compact('articles', 'categories'));
    }

    // Legal pages
    public function terms() { return view('frontend.forex.legal.terms'); }
    public function privacy() { return view('frontend.forex.legal.privacy'); }
    public function cookies() { return view('frontend.forex.legal.cookies'); }
}
