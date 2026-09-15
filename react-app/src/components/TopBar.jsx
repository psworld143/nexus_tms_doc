import { Link } from 'react-router-dom';
import ThemeToggle from './ThemeToggle';

const VideoIcon = () => (
    <svg fill="none" viewBox="0 0 24 24" stroke="currentColor" strokeWidth="1.8" strokeLinecap="round" strokeLinejoin="round">
        <path d="M15 10l4.553-2.276A1 1 0 0121 8.618v6.764a1 1 0 01-1.447.894L15 14M5 18h8a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v8a2 2 0 002 2z" />
    </svg>
);

const DocsIcon = () => (
    <svg fill="none" viewBox="0 0 24 24" stroke="currentColor" strokeWidth="1.8" strokeLinecap="round" strokeLinejoin="round">
        <path d="M14 2H6a2 2 0 00-2 2v16a2 2 0 002 2h12a2 2 0 002-2V8z" />
        <path d="M14 2v6h6" />
        <path d="M10 11l5 3-5 3z" fill="currentColor" stroke="none" />
    </svg>
);

const PlayIcon = () => (
    <svg fill="none" viewBox="0 0 24 24" stroke="currentColor" strokeWidth="1.8" strokeLinecap="round" strokeLinejoin="round">
        <path d="M14.752 11.168l-3.197-2.132A1 1 0 0010 9.87v4.263a1 1 0 001.555.832l3.197-2.132a1 1 0 000-1.664z" />
        <path d="M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
    </svg>
);

const SettingsIcon = () => (
    <svg fill="none" viewBox="0 0 24 24" stroke="currentColor" strokeWidth="1.8" strokeLinecap="round" strokeLinejoin="round">
        <path d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z" />
        <path d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
    </svg>
);

const CloseIcon = () => (
    <svg fill="none" viewBox="0 0 24 24" stroke="currentColor" strokeWidth="2" strokeLinecap="round" strokeLinejoin="round">
        <path d="M6 18L18 6M6 6l12 12" />
    </svg>
);

export default function TopBar({ subtitle = 'DISPATCH', showShortcuts = true, showBack = true }) {
    return (
        <div className="topbar">
            <div className="brand">
                <Link to="/">
                    <span className="brand-icon">
                        <VideoIcon />
                    </span>
                    <span className="brand-text">
                        <h1>DISPATCH</h1>
                        <p>{subtitle}</p>
                    </span>
                </Link>
            </div>
            <div className="topbar-actions">
                {showShortcuts && (
                    <>
                        <Link to="/docs" className="theme-btn shortcut-btn" title="Video Docs" style={{ textDecoration: 'none' }}>
                            <DocsIcon />
                        </Link>
                        <Link to="/tutorials" className="theme-btn shortcut-btn" title="Video Tutorials" style={{ textDecoration: 'none' }}>
                            <PlayIcon />
                        </Link>
                    </>
                )}
                <ThemeToggle />
                <button className="theme-btn" title="Settings" aria-label="Open settings">
                    <SettingsIcon />
                </button>
                {showBack && (
                    <Link to="/" className="back-home-btn">
                        <CloseIcon />
                    </Link>
                )}
            </div>
        </div>
    );
}
