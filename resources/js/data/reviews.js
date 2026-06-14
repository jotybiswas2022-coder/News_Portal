export const reviews = [
  {
    id: 1,
    date: '2026-01-29',
    rating: 5,
    verified: true,
    text: 'Clean scalper that does exactly what it promises. Been using Dark Algo for 6 months and the consistency is remarkable. Drawdown is well controlled and the support team is responsive.',
    reviewer: 'Marco Scherer',
    source: 'mql5 community',
    sourceUrl: '#'
  },
  {
    id: 2,
    date: '2026-01-15',
    rating: 5,
    verified: true,
    text: 'I was skeptical at first but after trying the free trial I was convinced. Dark Nova handles multiple pairs effortlessly. Best investment I\'ve made for my trading career.',
    reviewer: 'James Wilson',
    source: 'mql5 community',
    sourceUrl: '#'
  },
  {
    id: 3,
    date: '2025-12-28',
    rating: 5,
    verified: true,
    text: 'Using Dark Titan on a VPS and it runs 24/5 without any issues. The scalping strategy is perfect for my trading style. Averaging 3-5% monthly returns with low drawdown.',
    reviewer: 'Alex Chen',
    source: 'mql5 community',
    sourceUrl: '#'
  },
  {
    id: 4,
    date: '2025-12-10',
    rating: 5,
    verified: true,
    text: 'Dark Gold is a game changer for XAUUSD trading. The news filter saved me from significant losses during NFP releases. Highly recommended for gold traders.',
    reviewer: 'Robert Kim',
    source: 'mql5 community',
    sourceUrl: '#'
  },
  {
    id: 5,
    date: '2025-11-22',
    rating: 4,
    verified: true,
    text: 'Been using Dark Kronos for over a year now. Steady performance through different market conditions. The session-based approach really works well with my trading schedule.',
    reviewer: 'Sarah Johnson',
    source: 'mql5 community',
    sourceUrl: '#'
  },
  {
    id: 6,
    date: '2025-11-05',
    rating: 5,
    verified: true,
    text: 'The transparency is what sold me. Real Myfxbook results, not backtest fantasies. Dark Algo has been performing exactly as advertised. Support team is always helpful.',
    reviewer: 'Michael Torres',
    source: 'mql5 community',
    sourceUrl: '#'
  },
  {
    id: 7,
    date: '2025-10-18',
    rating: 5,
    verified: true,
    text: 'I own both Dark Algo and Dark Nova. The bundle price was unbeatable. Running them on separate accounts for diversification. Best EAs I have ever used, period.',
    reviewer: 'David Park',
    source: 'mql5 community',
    sourceUrl: '#'
  },
  {
    id: 8,
    date: '2025-10-01',
    rating: 5,
    verified: true,
    text: 'Customer support is outstanding. Had a small configuration issue and it was resolved within hours. The EA itself is rock solid. Highly recommended for serious traders.',
    reviewer: 'Thomas Berg',
    source: 'mql5 community',
    sourceUrl: '#'
  }
]

export const sourceCodes = [
  {
    id: 'sc-algo',
    name: 'Dark Algo Source Code',
    description: 'Complete MQL5 source code for Dark Algo EA. Includes stochastic indicator, signal detection algorithms, and risk management modules.',
    price: 999,
    available: true
  },
  {
    id: 'sc-nova',
    name: 'Dark Nova Source Code',
    description: 'Full source code for Dark Nova multi-currency EA. Neural network filtering, multi-pair correlation engine, and adaptive position sizing.',
    price: 1299,
    available: true
  },
  {
    id: 'sc-kronos',
    name: 'Dark Kronos Source Code',
    description: 'Source code for Dark Kronos time-based trading system. Session detection algorithms, TWAP calculation engine, and trend analysis modules.',
    price: 899,
    available: false
  },
  {
    id: 'sc-titan',
    name: 'Dark Titan Source Code',
    description: 'Complete Dark Titan scalping system source code. Low-latency execution engine, momentum detection, and order management system.',
    price: 1199,
    available: true
  },
  {
    id: 'sc-gold',
    name: 'Dark Gold Source Code',
    description: 'Dark Gold XAUUSD specialist source code. Gold volatility index calculation, news event filter, and correlation analysis engine.',
    price: 1499,
    available: true
  }
]

export const freeEAs = [
  {
    id: 'free-momentum',
    name: 'Momentum Tracker Free',
    description: 'Simple momentum-based EA for beginners. Tracks market momentum on EURUSD and enters trades based on RSI and MACD crossovers.',
    mt4: true,
    mt5: true,
    available: true
  },
  {
    id: 'free-grid',
    name: 'Grid Master Lite',
    description: 'Basic grid trading EA with martingale protection. Suitable for sideway markets on major currency pairs.',
    mt4: true,
    mt5: false,
    available: true
  },
  {
    id: 'free-trend',
    name: 'Trend Follower Free',
    description: 'Simple trend following EA using moving average crossovers. Includes basic money management and trailing stop functionality.',
    mt4: true,
    mt5: true,
    available: true
  },
  {
    id: 'free-scalper',
    name: 'Quick Scalper Free',
    description: 'Basic scalping EA for M1 and M5 timeframes. Opens and closes trades quickly targeting small profits.',
    mt4: true,
    mt5: true,
    available: true
  },
  {
    id: 'free-breakout',
    name: 'Breakout Hunter Free',
    description: 'Simple breakout detection EA for ranging markets. Identifies support and resistance levels and trades breakouts.',
    mt4: false,
    mt5: true,
    available: true
  }
]
