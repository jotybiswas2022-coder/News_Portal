export const generalFAQs = [
  {
    id: 1,
    question: 'Is it a one-time payment?',
    answer: 'Yes! All our Expert Advisors are available for a one-time payment. There are no recurring fees or subscription charges. You get lifetime access with free updates.'
  },
  {
    id: 2,
    question: 'My EA isn\'t opening orders, what should I do?',
    answer: 'First, check if the EA is properly attached to a chart with the correct timeframe. Ensure AutoTrading is enabled in your MT4/MT5 terminal. Check the Experts tab in the terminal window for any error messages. If issues persist, contact our support team with screenshots of the error.'
  },
  {
    id: 3,
    question: 'How many members use your EAs?',
    answer: 'We have over 1 million traders who have downloaded and are using our Expert Advisors. Our community continues to grow as traders discover the reliability and performance of our solutions.'
  },
  {
    id: 4,
    question: 'Which broker do you recommend?',
    answer: 'We recommend brokers with ECN/STP execution models that offer competitive spreads and fast execution. IC Markets, Pepperstone, and FXTM are popular choices among our users. The EA works with any broker that supports MQL5-compatible platforms.'
  },
  {
    id: 5,
    question: 'Which VPS do you recommend?',
    answer: 'For optimal 24/7 performance, we recommend using a VPS hosted close to your broker\'s servers. Forex VPS providers like ForexVPS.net, CheapVPS, or your broker\'s own VPS service are excellent choices. Minimum requirements: 1GB RAM, 1 CPU core, Windows Server 2016+.'
  },
  {
    id: 6,
    question: 'Is there a free trial available?',
    answer: 'Yes! We offer a free trial version of our EAs that works on demo accounts for 7 days. This allows you to test the EA\'s performance and compatibility with your broker before making a purchase.'
  },
  {
    id: 7,
    question: 'Can the EA be used with FIFO brokers?',
    answer: 'Yes, all our EAs are fully compatible with FIFO (First In, First Out) brokers. The EA\'s order management system has been designed to comply with FIFO regulations automatically.'
  },
  {
    id: 8,
    question: 'There is no TP & SL on my trades, why?',
    answer: 'Some of our EAs use dynamic stop loss and take profit levels that are managed by the EA itself rather than preset orders. This allows for more flexible position management. Check the EA settings to configure your preferred risk management parameters.'
  },
  {
    id: 9,
    question: 'Should I trade during holidays?',
    answer: 'We recommend avoiding trading during major holidays when market liquidity is low. Our EAs include a holiday calendar filter that can be enabled to automatically pause trading during low-liquidity periods.'
  },
  {
    id: 10,
    question: 'How does the license work?',
    answer: 'Each license allows you to install the EA on one MT4/MT5 account. Our flexible licensing options let you purchase additional licenses at discounted rates. Licenses are tied to your account, not your computer, so you can use them on any VPS or computer.'
  },
  {
    id: 11,
    question: 'My broker leverage is limited to 1:25. Would it be good?',
    answer: 'Yes, our EAs are designed to work with leverage as low as 1:10. Lower leverage actually provides an additional safety margin. The EA\'s position sizing algorithm automatically adjusts to your account leverage settings.'
  },
  {
    id: 12,
    question: 'Is there a minimum deposit for EAs?',
    answer: 'We recommend a minimum deposit of $100 for standard accounts and $500 for cent accounts. However, the actual minimum depends on your risk settings and the specific EA you\'re using. Check the product documentation for specific recommendations.'
  }
]

export const knowledgeArticles = [
  {
    id: 1,
    title: 'Getting Started with Your First EA',
    category: 'Getting Started',
    categorySlug: 'getting-started',
    date: '2026-01-15',
    excerpt: 'Learn how to install and configure your first Expert Advisor on MT4/MT5. Step-by-step guide from download to live trading.',
    content: '<p>Welcome to the world of automated trading! This guide will walk you through the process of setting up your first Expert Advisor (EA) on MetaTrader 4 or 5.</p><h3>Step 1: Download Your EA</h3><p>After purchase, you will receive a download link via email. Download the .ex4 or .ex5 file to your computer.</p><h3>Step 2: Install the EA</h3><p>Copy the EA file to the Experts folder in your MT4/MT5 data directory. Restart your platform and refresh the Navigator panel.</p><h3>Step 3: Configure Settings</h3><p>Drag the EA onto your desired chart and adjust the input parameters according to your risk tolerance and trading preferences.</p>'
  },
  {
    id: 2,
    title: 'Installing EAs on VPS for 24/7 Trading',
    category: 'Installation Guide',
    categorySlug: 'installation',
    date: '2026-01-10',
    excerpt: 'Step-by-step guide to install and run your Expert Advisors on a Virtual Private Server for uninterrupted trading.',
    content: '<p>Running your EA on a VPS ensures 24/7 operation without relying on your personal computer.</p><h3>Why Use a VPS?</h3><p>A VPS provides reliable uptime, low latency connection to your broker, and protection against power outages or internet interruptions.</p>'
  },
  {
    id: 3,
    title: 'Understanding EA Settings and Parameters',
    category: 'Getting Started',
    categorySlug: 'getting-started',
    date: '2026-01-05',
    excerpt: 'Comprehensive guide to understanding all the configurable parameters in your Expert Advisor.',
    content: '<p>Each EA comes with configurable parameters that allow you to customize its behavior.</p><h3>Risk Management</h3><p>Learn how to set lot sizes, stop loss, take profit, and maximum drawdown limits to match your risk tolerance.</p>'
  },
  {
    id: 4,
    title: 'Troubleshooting Common EA Issues',
    category: 'Troubleshooting',
    categorySlug: 'troubleshooting',
    date: '2025-12-28',
    excerpt: 'Solutions for the most common problems users face when running Expert Advisors.',
    content: '<p>Common issues and their solutions:</p><ul><li><strong>EA not trading:</strong> Check AutoTrading is enabled</li><li><strong>No orders opened:</strong> Verify the EA is properly attached to a chart</li><li><strong>Connection errors:</strong> Check your internet/VPS connection</li></ul>'
  },
  {
    id: 5,
    title: 'Optimizing Broker Settings for EAs',
    category: 'Broker Settings',
    categorySlug: 'broker-settings',
    date: '2025-12-20',
    excerpt: 'How to configure your broker account for optimal EA performance and execution.',
    content: '<p>For optimal EA performance, configure your broker account with ECN/STP execution, competitive spreads, and reliable trade execution.</p>'
  },
  {
    id: 6,
    title: 'License Management and Activation',
    category: 'License & Account',
    categorySlug: 'license',
    date: '2025-12-15',
    excerpt: 'How to manage your licenses, activate new installations, and transfer licenses between accounts.',
    content: '<p>Managing your EA licenses is straightforward. Each purchase includes a specific number of licenses that can be activated on different accounts.</p>'
  },
  {
    id: 7,
    title: 'Risk Management Best Practices',
    category: 'Getting Started',
    categorySlug: 'getting-started',
    date: '2025-12-10',
    excerpt: 'Essential risk management principles every automated trader should follow.',
    content: '<p>Proper risk management is crucial for long-term trading success. Never risk more than 1-2% of your account on any single trade.</p>'
  },
  {
    id: 8,
    title: 'Backtesting Your EA Strategy',
    category: 'Installation Guide',
    categorySlug: 'installation',
    date: '2025-12-05',
    excerpt: 'How to properly backtest your Expert Advisor using historical data to evaluate performance.',
    content: '<p>Backtesting helps you understand how your EA would have performed in historical market conditions. Use the Strategy Tester in MT4/MT5.</p>'
  },
  {
    id: 9,
    title: 'EA Not Opening Trades: Complete Fix Guide',
    category: 'Troubleshooting',
    categorySlug: 'troubleshooting',
    date: '2025-11-28',
    excerpt: 'Comprehensive troubleshooting guide when your Expert Advisor is not opening trades.',
    content: '<p>If your EA is not opening trades, work through this checklist: check AutoTrading, verify chart timeframe compatibility, check account margin, and review EA input parameters.</p>'
  },
  {
    id: 10,
    title: 'Forward Testing vs Backtesting',
    category: 'Getting Started',
    categorySlug: 'getting-started',
    date: '2025-11-20',
    excerpt: 'Understanding the differences between forward testing and backtesting for EA validation.',
    content: '<p>Forward testing on a demo account is the final validation step before going live. It tests the EA in current market conditions with real-time execution.</p>'
  },
  {
    id: 11,
    title: 'VPS Selection Guide for Forex Trading',
    category: 'Installation Guide',
    categorySlug: 'installation',
    date: '2025-11-15',
    excerpt: 'How to choose the right VPS provider and plan for your automated trading needs.',
    content: '<p>Choose a VPS provider with low latency to your broker, reliable uptime guarantee, and adequate computing resources for your EAs.</p>'
  },
  {
    id: 12,
    title: 'Understanding Drawdown and Risk Metrics',
    category: 'Broker Settings',
    categorySlug: 'broker-settings',
    date: '2025-11-10',
    excerpt: 'Learn about key performance metrics like drawdown, Sharpe ratio, and profit factor.',
    content: '<p>Understanding performance metrics helps you evaluate your EA\'s performance objectively. Focus on risk-adjusted returns rather than absolute profits.</p>'
  },
  {
    id: 13,
    title: 'Multi-EA Account Management',
    category: 'Troubleshooting',
    categorySlug: 'troubleshooting',
    date: '2025-11-05',
    excerpt: 'Best practices for running multiple Expert Advisors on a single trading account.',
    content: '<p>Running multiple EAs on one account requires careful position sizing and correlation analysis to avoid overexposure.</p>'
  },
  {
    id: 14,
    title: 'License Transfer and Account Changes',
    category: 'License & Account',
    categorySlug: 'license',
    date: '2025-10-30',
    excerpt: 'How to transfer your EA licenses between accounts and handle account changes.',
    content: '<p>License transfers are handled through our support system. Contact us with your old and new account details for a smooth transfer.</p>'
  },
  {
    id: 15,
    title: 'Economic Calendar Integration',
    category: 'Broker Settings',
    categorySlug: 'broker-settings',
    date: '2025-10-25',
    excerpt: 'How to configure news filtering and economic calendar integration for safer trading.',
    content: '<p>Some of our EAs include news filter capabilities that automatically pause trading during high-impact economic events.</p>'
  },
  {
    id: 16,
    title: 'Maximizing EA Performance with Proper Settings',
    category: 'Getting Started',
    categorySlug: 'getting-started',
    date: '2025-10-20',
    excerpt: 'Tips and tricks to optimize your Expert Advisor for maximum performance.',
    content: '<p>Start with conservative settings and gradually optimize based on forward testing results. Document all changes for reference.</p>'
  }
]

export const knowledgeCategories = [
  { slug: 'getting-started', name: 'Getting Started', count: 5, icon: 'BookOpen' },
  { slug: 'installation', name: 'Installation Guide', count: 8, icon: 'Download' },
  { slug: 'troubleshooting', name: 'Troubleshooting', count: 12, icon: 'Wrench' },
  { slug: 'broker-settings', name: 'Broker Settings', count: 6, icon: 'Settings' },
  { slug: 'license', name: 'License & Account', count: 4, icon: 'Key' }
]
