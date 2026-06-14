export const products = [
  {
    id: 'dark-algo',
    name: 'Dark Algo',
    slug: 'dark-algo',
    tagline: 'EURUSD & GBPUSD Mastery',
    description: 'Precision scalping for major pairs with advanced stochastic signal detection. Dark Algo is a fully automated Expert Advisor designed for EURUSD and GBPUSD, delivering consistent performance with minimal drawdown.',
    indicator: 'Stochastic Indicator',
    pairs: ['EURUSD', 'GBPUSD'],
    features: [
      'Advanced Signal Detection',
      'Insightful Performance Analysis',
      'Real Trading, Real Results',
      'Low Drawdown Strategy',
    ],
    plans: [
      { id: 1, name: 'Dark Algo', price: 399, licenses: 5, vps: '1 Month', features: ['5 Flexible Licenses', 'MT4 & MT5', 'Free Updates', 'Free 1 Month VPS', 'Stochastic Indicator', 'All Set Files', 'Installation Guide', 'Lifetime Membership'], available: true },
      { id: 2, name: 'Dark Algo+', price: 599, licenses: 10, vps: '3 Months', features: ['10 Flexible Licenses', 'MT4 & MT5', 'Free Updates', 'Free 3 Months VPS', 'Stochastic Indicator', 'All Set Files', 'Installation Guide', 'Lifetime Membership'], available: true }
    ],
    reviews: 150,
    liveSignalYears: 3,
    heroTagline: 'Precision Scalping at Your Fingertips',
    sectionA: {
      tagline: 'Advanced Signal Detection',
      title: 'Optimize Your Trades Accuracy',
      text: 'Dark Algo uses a sophisticated Stochastic indicator system combined with advanced filtering algorithms to identify high-probability trading opportunities. Each signal is validated through multiple timeframes before execution.'
    },
    sectionB: {
      tagline: 'Insightful Performance Analysis',
      title: 'Understanding Potential with Dark Algo',
      text: 'Extensive backtesting over 10+ years of historical data demonstrates consistent returns with maximum drawdown under 15%. Our proprietary risk management ensures capital preservation during volatile market conditions.'
    },
    sectionC: {
      tagline: 'Real Trading, Real Results',
      title: 'Dark Algo 3-Year Conservative Signal',
      text: 'Live trading results over 3 years show steady equity growth with a Sharpe ratio exceeding 2.0. Verified track records available on Myfxbook and MQL5 community.'
    }
  },
  {
    id: 'dark-nova',
    name: 'Dark Nova',
    slug: 'dark-nova',
    tagline: 'Multi-Currency Precision Engine',
    description: 'Dark Nova is a multi-currency Expert Advisor that excels across multiple forex pairs simultaneously. Advanced neural network filtering ensures only the highest probability trades are executed.',
    indicator: 'RSI Divergence + ATR Filter',
    pairs: ['EURUSD', 'GBPUSD', 'USDJPY', 'AUDUSD'],
    features: [
      'Multi-Currency Trading',
      'Neural Network Filtering',
      'Adaptive Risk Management',
      '24/5 Automated Trading',
    ],
    plans: [
      { id: 3, name: 'Dark Nova', price: 499, licenses: 5, vps: '1 Month', features: ['5 Flexible Licenses', 'MT4 & MT5', 'Free Updates', 'Free 1 Month VPS', 'RSI Divergence', 'All Set Files', 'Installation Guide', 'Lifetime Membership'], available: true },
      { id: 4, name: 'Dark Nova+', price: 749, licenses: 10, vps: '3 Months', features: ['10 Flexible Licenses', 'MT4 & MT5', 'Free Updates', 'Free 3 Months VPS', 'RSI Divergence', 'All Set Files', 'Installation Guide', 'Lifetime Membership'], available: true }
    ],
    reviews: 98,
    liveSignalYears: 2,
    heroTagline: 'Next-Generation Multi-Currency Trading',
    sectionA: {
      tagline: 'Advanced Analytics',
      title: 'Multi-Currency Market Analysis',
      text: 'Dark Nova continuously monitors multiple currency pairs, identifying correlation patterns and divergences that signal high-probability entries. The system adapts to changing market conditions in real-time.'
    },
    sectionB: {
      tagline: 'Risk Optimization',
      title: 'Intelligent Position Sizing',
      text: 'Our proprietary ATR-based position sizing algorithm dynamically adjusts lot sizes based on market volatility, ensuring consistent risk exposure across all trades regardless of market conditions.'
    },
    sectionC: {
      tagline: 'Live Performance',
      title: '2 Years of Verified Results',
      text: 'Dark Nova has been trading live for over 2 years with consistent monthly returns. All results are verified on Myfxbook with full transparency.'
    }
  },
  {
    id: 'dark-kronos',
    name: 'Dark Kronos',
    slug: 'dark-kronos',
    tagline: 'Time-Based Trading Excellence',
    description: 'Dark Kronos utilizes time-based market analysis combined with price action to identify the most favorable trading sessions. Optimized for London and New York session overlaps.',
    indicator: 'Time-Weighted Average Price',
    pairs: ['EURUSD', 'GBPUSD', 'USDJPY'],
    features: [
      'Session-Based Trading',
      'Price Action Analysis',
      'Trend Following System',
      'Automated Risk Controls',
    ],
    plans: [
      { id: 5, name: 'Dark Kronos', price: 349, licenses: 5, vps: '1 Month', features: ['5 Flexible Licenses', 'MT4 & MT5', 'Free Updates', 'Free 1 Month VPS', 'TWAP Indicator', 'All Set Files', 'Installation Guide', 'Lifetime Membership'], available: true },
      { id: 6, name: 'Dark Kronos+', price: 549, licenses: 10, vps: '3 Months', features: ['10 Flexible Licenses', 'MT4 & MT5', 'Free Updates', 'Free 3 Months VPS', 'TWAP Indicator', 'All Set Files', 'Installation Guide', 'Lifetime Membership'], available: false }
    ],
    reviews: 76,
    liveSignalYears: 4,
    heroTagline: 'Master Time, Master the Markets',
    sectionA: {
      tagline: 'Session Intelligence',
      title: 'Trade When It Matters Most',
      text: 'Dark Kronos identifies the most liquid trading sessions and executes trades during peak market hours. The system avoids low-volatility periods, reducing false signals and improving win rates.'
    },
    sectionB: {
      tagline: 'Trend Analysis',
      title: 'Ride the Market Waves',
      text: 'Advanced trend detection algorithms identify emerging trends early, allowing Dark Kronos to enter positions at the beginning of significant market moves while maintaining tight stop losses.'
    },
    sectionC: {
      tagline: 'Track Record',
      title: '4 Years of Market Proof',
      text: 'With 4 years of live trading history, Dark Kronos has demonstrated remarkable consistency across various market conditions, including high-volatility news events and low-volatility consolidation periods.'
    }
  },
  {
    id: 'dark-titan',
    name: 'Dark Titan',
    slug: 'dark-titan',
    tagline: 'High-Frequency Scalping System',
    description: 'Dark Titan is designed for traders who want frequent, small profits throughout the day. Ultra-low latency execution and precise entry timing make it ideal for scalping strategies.',
    indicator: 'Momentum + Volume Analysis',
    pairs: ['EURUSD', 'GBPUSD'],
    features: [
      'Ultra-Fast Execution',
      'Scalping Strategy',
      'Tight Spread Optimization',
      'Low Drawdown Profile',
    ],
    plans: [
      { id: 7, name: 'Dark Titan', price: 449, licenses: 5, vps: '1 Month', features: ['5 Flexible Licenses', 'MT4 & MT5', 'Free Updates', 'Free 1 Month VPS', 'Momentum Indicator', 'All Set Files', 'Installation Guide', 'Lifetime Membership'], available: true },
      { id: 8, name: 'Dark Titan+', price: 699, licenses: 10, vps: '3 Months', features: ['10 Flexible Licenses', 'MT4 & MT5', 'Free Updates', 'Free 3 Months VPS', 'Momentum Indicator', 'All Set Files', 'Installation Guide', 'Lifetime Membership'], available: true }
    ],
    reviews: 212,
    liveSignalYears: 5,
    heroTagline: 'Scale Your Way to Profits',
    sectionA: {
      tagline: 'Speed & Precision',
      title: 'Lightning-Fast Trade Execution',
      text: 'Dark Titan is optimized for low-latency execution, ensuring your trades are filled at the best possible prices. The system monitors order book depth and spread conditions in real-time.'
    },
    sectionB: {
      tagline: 'Scalping Strategy',
      title: 'Small Profits, Big Returns',
      text: 'By capturing small price movements multiple times daily, Dark Titan compounds returns efficiently. Average trade duration is under 5 minutes with a win rate exceeding 75%.'
    },
    sectionC: {
      tagline: 'Proven Track Record',
      title: '5 Years of Scalping Excellence',
      text: 'Dark Titan has been the most popular EA in our portfolio with over 212 positive reviews and 5 years of verified live trading results.'
    }
  },
  {
    id: 'dark-gold',
    name: 'Dark Gold',
    slug: 'dark-gold',
    tagline: 'XAUUSD Gold Trading Specialist',
    description: 'Dark Gold is purpose-built for gold (XAUUSD) trading. It understands the unique behavior of gold markets and capitalizes on gold-specific price patterns and correlations.',
    indicator: 'Gold Volatility Index',
    pairs: ['XAUUSD'],
    features: [
      'Gold-Optimized Strategy',
      'News Event Filter',
      'Correlation Analysis',
      'Premium Risk Management',
    ],
    plans: [
      { id: 9, name: 'Dark Gold', price: 549, licenses: 5, vps: '1 Month', features: ['5 Flexible Licenses', 'MT4 & MT5', 'Free Updates', 'Free 1 Month VPS', 'Gold Volatility Index', 'All Set Files', 'Installation Guide', 'Lifetime Membership'], available: true },
      { id: 10, name: 'Dark Gold+', price: 849, licenses: 10, vps: '3 Months', features: ['10 Flexible Licenses', 'MT4 & MT5', 'Free Updates', 'Free 3 Months VPS', 'Gold Volatility Index', 'All Set Files', 'Installation Guide', 'Lifetime Membership'], available: false }
    ],
    reviews: 134,
    liveSignalYears: 3,
    heroTagline: 'The Golden Edge in Trading',
    sectionA: {
      tagline: 'Gold Market Expertise',
      title: 'Purpose-Built for XAUUSD',
      text: 'Dark Gold incorporates gold-specific market analysis, including COMEX futures correlation, gold ETF flows, and macroeconomic factors that drive gold prices.'
    },
    sectionB: {
      tagline: 'Smart Filtering',
      title: 'News-Aware Trading',
      text: 'Integrated economic calendar filter prevents trading during high-impact news events that could cause unpredictable gold price swings. The system resumes normal operation after market stabilization.'
    },
    sectionC: {
      tagline: 'Verified Results',
      title: '3 Years of Gold Trading Success',
      text: 'Dark Gold has consistently outperformed in gold markets with a focus on capital preservation. All results are independently verified on Myfxbook.'
    }
  }
]

export const bundles = [
  {
    id: 'starter',
    name: 'Starter Bundle',
    price: 268,
    originalPrice: 599,
    period: 'One Time',
    popular: false,
    products: ['Dark Titan', 'Dark Gold'],
    features: ['5+5 Licenses', 'Free Updates', 'Free 1 Month VPS', 'Dark Inversion Indicators', 'Installation Guide'],
    licenses: '5+5',
    available: true
  },
  {
    id: 'premium',
    name: 'Premium Bundle',
    price: 790,
    originalPrice: 1599,
    period: 'One Time',
    popular: true,
    products: ['Dark Algo', 'Dark Nova'],
    features: ['5+5 Licenses', 'Free Updates', 'Free 3 Months VPS', 'All Set Files', 'Lifetime Membership', 'Installation Guide'],
    licenses: '5+5',
    available: true
  },
  {
    id: 'advanced',
    name: 'Advanced Bundle',
    price: 1690,
    originalPrice: 2999,
    period: 'One Time',
    popular: false,
    products: ['Dark Algo', 'Dark Nova', 'Dark Kronos'],
    features: ['5+5+5 Licenses', 'Free Updates', 'Free 1 Month VPS', 'All Set Files', 'Lifetime Membership', 'Installation Guide'],
    licenses: '5+5+5',
    available: true
  }
]

export const trustMetrics = [
  {
    icon: 'Award',
    title: 'Decade of Expertise',
    description: 'Trusted by Over a Million Traders',
    detail: '10+ years, 1M+ downloads, 4,136+ verified reviews'
  },
  {
    icon: 'TrendingUp',
    title: 'No False Promises, Just Results',
    description: 'Verified Myfxbook & MQL5 Track-records',
    detail: '99.90% backtest precision, real account results'
  },
  {
    icon: 'Globe',
    title: 'Chosen by Traders Worldwide',
    description: 'Explore Our Global Footprint',
    detail: '120+ countries, mql5.com statistics'
  }
]

export const featuresWhyChoose = [
  { icon: 'Sliders', title: 'High Customization', description: 'Tailor every parameter to your trading style and risk tolerance.' },
  { icon: 'Shield', title: 'Proven Transparency', description: 'All results verified on Myfxbook with real account statements.' },
  { icon: 'BarChart3', title: 'Market Resilience', description: 'Tested across bull, bear, and sideways markets for consistent performance.' },
  { icon: 'Headphones', title: 'Direct Support', description: 'Get direct support from our team of trading experts.' },
  { icon: 'Cpu', title: 'Innovative Technology', description: 'Cutting-edge algorithms powered by machine learning and neural networks.' },
  { icon: 'Smile', title: 'User-Friendly Interface', description: 'Easy setup with comprehensive documentation and video tutorials.' }
]
