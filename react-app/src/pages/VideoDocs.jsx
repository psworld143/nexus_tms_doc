import { useState, useMemo } from 'react';
import TopBar from '../components/TopBar';
import BackgroundCanvas from '../components/BackgroundCanvas';
import { videoCatalog, videoDocs } from '../data';
import './VideoDocs.css';

const VideoIcon = () => (
    <svg fill="none" viewBox="0 0 24 24" stroke="currentColor" strokeWidth="1.8" strokeLinecap="round" strokeLinejoin="round">
        <path d="M14.752 11.168l-3.197-2.132A1 1 0 0010 9.87v4.263a1 1 0 001.555.832l3.197-2.132a1 1 0 000-1.664z" />
        <path d="M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
    </svg>
);

const SearchIcon = () => (
    <svg fill="none" viewBox="0 0 24 24" stroke="currentColor" strokeWidth="2" strokeLinecap="round" strokeLinejoin="round">
        <circle cx="11" cy="11" r="8" />
        <path d="M21 21l-4.35-4.35" />
    </svg>
);

const CloseIcon = () => (
    <svg fill="none" viewBox="0 0 24 24" stroke="currentColor" strokeWidth="2" strokeLinecap="round" strokeLinejoin="round">
        <path d="M6 18L18 6M6 6l12 12" />
    </svg>
);

const categories = ['Main', 'Operations', 'Fleet', 'Finance', 'Safety', 'Compliance', 'Account'];

export default function VideoDocs() {
    const [search, setSearch] = useState('');
    const [activeCategory, setActiveCategory] = useState('All');
    const [selectedDoc, setSelectedDoc] = useState(null);

    const filtered = useMemo(() => {
        return videoCatalog.filter(v => {
            if (activeCategory !== 'All' && v.category !== activeCategory) return false;
            if (search) {
                const q = search.toLowerCase();
                if (!(v.title + ' ' + v.desc).toLowerCase().includes(q)) return false;
            }
            return true;
        });
    }, [search, activeCategory]);

    return (
        <>
            <BackgroundCanvas />
            <TopBar subtitle="Video Docs" />
            <div className="page">
                <div className="vd-hero">
                    <div className="vd-hero-badge">
                        <VideoIcon />
                        Documentation
                    </div>
                    <h1>Video Documentation</h1>
                    <p>Browse guides for every DISPATCH module. Click any card to read the full documentation.</p>
                </div>

                <div className="vd-controls">
                    <div className="vd-search">
                        <SearchIcon />
                        <input
                            type="text"
                            placeholder="Search documentation..."
                            value={search}
                            onChange={e => setSearch(e.target.value)}
                            aria-label="Search documentation"
                        />
                    </div>
                    <div className="vd-chips">
                        <button
                            className={`vd-chip ${activeCategory === 'All' ? 'active' : ''}`}
                            onClick={() => setActiveCategory('All')}
                        >All</button>
                        {categories.map(cat => (
                            <button
                                key={cat}
                                className={`vd-chip ${activeCategory === cat ? 'active' : ''}`}
                                onClick={() => setActiveCategory(cat)}
                            >{cat}</button>
                        ))}
                    </div>
                </div>

                <div className="vd-grid">
                    {filtered.map(v => (
                        <div
                            key={v.id}
                            className="vd-card"
                            data-status={v.duration ? 'available' : 'coming'}
                            onClick={() => setSelectedDoc(v)}
                        >
                            <div className="vd-card-icon">
                                <VideoIcon />
                            </div>
                            <div className="vd-card-body">
                                <span className="vd-card-cat">{v.category}</span>
                                <h3>{v.title}</h3>
                                <p>{v.desc}</p>
                            </div>
                            {v.duration && <span className="vd-card-duration">{v.duration}</span>}
                        </div>
                    ))}
                </div>

                {filtered.length === 0 && (
                    <div className="vd-empty">
                        <h3>No documentation found</h3>
                        <p>Try a different search or category.</p>
                    </div>
                )}
            </div>

            {selectedDoc && (
                <div className="vd-modal-overlay" onClick={e => { if (e.target.classList.contains('vd-modal-overlay')) setSelectedDoc(null); }}>
                    <div className="vd-modal">
                        <div className="vd-modal-header">
                            <span className="vd-modal-cat">{selectedDoc.category}</span>
                            <h2>{selectedDoc.title}</h2>
                            <button className="vd-modal-close" onClick={() => setSelectedDoc(null)}>
                                <CloseIcon />
                            </button>
                        </div>
                        <div className="vd-modal-body">
                            <div
                                className="doc-rich-content"
                                dangerouslySetInnerHTML={{ __html: videoDocs[selectedDoc.id] || '<p>No documentation available.</p>' }}
                            />
                        </div>
                    </div>
                </div>
            )}
        </>
    );
}
