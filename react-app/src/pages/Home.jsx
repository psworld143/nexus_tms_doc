import { Link } from 'react-router-dom';
import TopBar from '../components/TopBar';
import BackgroundCanvas from '../components/BackgroundCanvas';
import { videoCatalog } from '../data';
import './Home.css';

const PlayIcon = () => (
    <svg fill="none" viewBox="0 0 24 24" stroke="currentColor" strokeWidth="1.8" strokeLinecap="round" strokeLinejoin="round">
        <path d="M14.752 11.168l-3.197-2.132A1 1 0 0010 9.87v4.263a1 1 0 001.555.832l3.197-2.132a1 1 0 000-1.664z" />
        <path d="M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
    </svg>
);

const DocsIcon = () => (
    <svg fill="none" viewBox="0 0 24 24" stroke="currentColor" strokeWidth="1.8" strokeLinecap="round" strokeLinejoin="round">
        <path d="M14 2H6a2 2 0 00-2 2v16a2 2 0 002 2h12a2 2 0 002-2V8z" />
        <path d="M14 2v6h6" />
    </svg>
);

const TruckIcon = () => (
    <svg fill="none" viewBox="0 0 24 24" stroke="currentColor" strokeWidth="1.8" strokeLinecap="round" strokeLinejoin="round">
        <path d="M1 3h15v13H1z" />
        <path d="M16 8h4l3 3v5h-7V8z" />
        <circle cx="5.5" cy="18.5" r="2.5" />
        <circle cx="18.5" cy="18.5" r="2.5" />
    </svg>
);

const ArrowIcon = () => (
    <svg fill="none" viewBox="0 0 24 24" stroke="currentColor" strokeWidth="2" strokeLinecap="round" strokeLinejoin="round">
        <path d="M5 12h14M12 5l7 7-7 7" />
    </svg>
);

const stats = [
    { label: 'Modules', value: videoCatalog.length },
    { label: 'Categories', value: 7 },
    { label: 'Tutorials', value: videoCatalog.filter(v => v.duration).length },
];

export default function Home() {
    return (
        <>
            <BackgroundCanvas />
            <TopBar subtitle="Trucking Management" />
            <div className="page home-page">
                <section className="home-hero">
                    <div className="home-hero-badge">
                        <TruckIcon />
                        DISPATCH Trucking Management
                    </div>
                    <h1>Training & Documentation Portal</h1>
                    <p>Learn every module of DISPATCH — from dashboard basics to compliance, fleet management, and accounting. Watch tutorials or read step-by-step guides.</p>
                    <div className="home-hero-actions">
                        <Link to="/tutorials" className="home-cta home-cta-primary">
                            <PlayIcon />
                            Watch Tutorials
                        </Link>
                        <Link to="/docs" className="home-cta home-cta-secondary">
                            <DocsIcon />
                            Read Documentation
                        </Link>
                    </div>
                </section>

                <section className="home-stats">
                    {stats.map(s => (
                        <div key={s.label} className="home-stat">
                            <span className="home-stat-value">{s.value}</span>
                            <span className="home-stat-label">{s.label}</span>
                        </div>
                    ))}
                </section>

                <section className="home-cards">
                    <Link to="/tutorials" className="home-card">
                        <div className="home-card-icon">
                            <PlayIcon />
                        </div>
                        <div className="home-card-body">
                            <h3>Video Tutorials</h3>
                            <p>Watch step-by-step video walkthroughs for every DISPATCH module.</p>
                        </div>
                        <ArrowIcon />
                    </Link>
                    <Link to="/docs" className="home-card">
                        <div className="home-card-icon">
                            <DocsIcon />
                        </div>
                        <div className="home-card-body">
                            <h3>Documentation</h3>
                            <p>Read detailed guides covering features, workflows, and best practices.</p>
                        </div>
                        <ArrowIcon />
                    </Link>
                </section>
            </div>
        </>
    );
}
