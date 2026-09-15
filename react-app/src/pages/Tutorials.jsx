import { useState, useEffect, useRef, useMemo } from 'react';
import TopBar from '../components/TopBar';
import BackgroundCanvas from '../components/BackgroundCanvas';
import { videoCatalog } from '../data';
import './Tutorials.css';

const PlayIcon = () => (
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

export default function Tutorials() {
    const [search, setSearch] = useState('');
    const [activeCategory, setActiveCategory] = useState('All');
    const [selectedVideo, setSelectedVideo] = useState(null);
    const [comments, setComments] = useState([]);
    const [commentText, setCommentText] = useState('');
    const [commentName, setCommentName] = useState('');
    const [sortMode, setSortMode] = useState('newest');
    const [showAllComments, setShowAllComments] = useState(true);
    const [autoplay, setAutoplay] = useState(true);
    const [upNextVideo, setUpNextVideo] = useState(null);
    const [upNextCountdown, setUpNextCountdown] = useState(0);
    const videoRef = useRef(null);
    const upNextTimerRef = useRef(null);

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

    const relatedVideos = useMemo(() => {
        if (!selectedVideo) return [];
        return videoCatalog
            .filter(v => v.id !== selectedVideo.id && v.category === selectedVideo.category)
            .slice(0, 6);
    }, [selectedVideo]);

    // Fetch comments
    const fetchComments = async (videoId) => {
        try {
            const url = videoId
                ? `/nexus_tms_doc/dispatch/api/comments.php?video_id=${encodeURIComponent(videoId)}`
                : '/nexus_tms_doc/dispatch/api/comments.php';
            const res = await fetch(url);
            const data = await res.json();
            if (data.ok && data.comments) {
                setComments(data.comments);
            }
        } catch (e) {
            setComments([]);
        }
    };

    useEffect(() => {
        fetchComments(showAllComments ? null : 'general');
    }, [showAllComments]);

    // Up-next logic
    useEffect(() => {
        if (relatedVideos.length > 0) {
            setUpNextVideo(relatedVideos[0]);
        } else {
            setUpNextVideo(null);
        }
        return () => {
            if (upNextTimerRef.current) clearTimeout(upNextTimerRef.current);
        };
    }, [relatedVideos]);

    const handleVideoEnd = () => {
        if (!upNextVideo) return;
        const duration = autoplay ? 3 : 8;
        setUpNextCountdown(duration);
        let remaining = duration;
        const interval = setInterval(() => {
            remaining -= 1;
            setUpNextCountdown(remaining);
            if (remaining <= 0) {
                clearInterval(interval);
                openVideo(upNextVideo);
            }
        }, 1000);
        upNextTimerRef.current = interval;
    };

    const cancelUpNext = () => {
        if (upNextTimerRef.current) {
            clearInterval(upNextTimerRef.current);
            upNextTimerRef.current = null;
        }
        setUpNextCountdown(0);
    };

    const openVideo = (video) => {
        cancelUpNext();
        setSelectedVideo(video);
        fetchComments(video.id);
        setTimeout(() => {
            if (videoRef.current) {
                videoRef.current.load();
                videoRef.current.play().catch(() => {});
            }
        }, 100);
    };

    const closeModal = () => {
        cancelUpNext();
        if (videoRef.current) {
            videoRef.current.pause();
        }
        setSelectedVideo(null);
        fetchComments(showAllComments ? null : 'general');
    };

    const submitComment = async (e) => {
        e.preventDefault();
        if (!commentText.trim() || !commentName.trim() || !selectedVideo) return;
        try {
            const res = await fetch('/nexus_tms_doc/dispatch/api/comments.php', {
                method: 'POST',
                headers: { 'Content-Type': 'application/json' },
                body: JSON.stringify({
                    video_id: selectedVideo.id,
                    name: commentName,
                    text: commentText,
                }),
            });
            const data = await res.json();
            if (data.ok) {
                setCommentText('');
                fetchComments(selectedVideo.id);
            }
        } catch (e) {}
    };

    const sortedComments = useMemo(() => {
        const arr = [...comments];
        if (sortMode === 'newest') arr.sort((a, b) => (b.created_at || '').localeCompare(a.created_at || ''));
        else if (sortMode === 'oldest') arr.sort((a, b) => (a.created_at || '').localeCompare(b.created_at || ''));
        else if (sortMode === 'top') arr.sort((a, b) => (b.likes || 0) - (a.likes || 0));
        return arr;
    }, [comments, sortMode]);

    return (
        <>
            <BackgroundCanvas />
            <TopBar subtitle="Video Tutorials" />
            <div className="page tutorials-page">
                <div className="tut-hero">
                    <div className="tut-hero-badge">
                        <PlayIcon />
                        Tutorials
                    </div>
                    <h1>Video Tutorials</h1>
                    <p>Watch walkthroughs for every DISPATCH module. Click any tutorial to play it.</p>
                </div>

                <div className="tut-controls">
                    <div className="tut-search">
                        <SearchIcon />
                        <input
                            type="text"
                            placeholder="Search tutorials..."
                            value={search}
                            onChange={e => setSearch(e.target.value)}
                            aria-label="Search tutorials"
                        />
                    </div>
                    <div className="tut-chips">
                        <button
                            className={`tut-chip ${activeCategory === 'All' ? 'active' : ''}`}
                            onClick={() => setActiveCategory('All')}
                        >All</button>
                        {categories.map(cat => (
                            <button
                                key={cat}
                                className={`tut-chip ${activeCategory === cat ? 'active' : ''}`}
                                onClick={() => setActiveCategory(cat)}
                            >{cat}</button>
                        ))}
                    </div>
                </div>

                <div className="tut-grid">
                    {filtered.map(v => (
                        <div
                            key={v.id}
                            className={`tut-card ${v.duration ? '' : 'coming'}`}
                            onClick={() => v.duration && openVideo(v)}
                        >
                            <div className="tut-card-thumb">
                                <PlayIcon />
                                {v.duration && <span className="tut-card-duration">{v.duration}</span>}
                            </div>
                            <div className="tut-card-body">
                                <span className="tut-card-cat">{v.category}</span>
                                <h3>{v.title}</h3>
                                <p>{v.desc}</p>
                            </div>
                        </div>
                    ))}
                </div>

                {filtered.length === 0 && (
                    <div className="tut-empty">
                        <h3>No tutorials found</h3>
                        <p>Try a different search or category.</p>
                    </div>
                )}
            </div>

            {selectedVideo && (
                <div className="tut-modal-overlay" onClick={e => { if (e.target.classList.contains('tut-modal-overlay')) closeModal(); }}>
                    <div className="tut-modal">
                        <div className="tut-modal-main">
                            <div className="tut-player-wrap">
                                <video
                                    ref={videoRef}
                                    controls
                                    preload="none"
                                    onEnded={handleVideoEnd}
                                    poster=""
                                >
                                    <source src={`/nexus_tms_doc/dispatch/${selectedVideo.src}`} type="video/mp4" />
                                </video>
                                {upNextCountdown > 0 && upNextVideo && (
                                    <div className="upnext-bar">
                                        <div className="upnext-info">
                                            <strong>Up next</strong>
                                            <span>{upNextVideo.title}</span>
                                        </div>
                                        <div className="upnext-actions">
                                            <button className="upnext-play" onClick={() => openVideo(upNextVideo)}>Play</button>
                                            <button className="upnext-cancel" onClick={cancelUpNext}>×</button>
                                        </div>
                                        <div className="upnext-countdown">{upNextCountdown}</div>
                                    </div>
                                )}
                            </div>
                            <div className="tut-modal-info">
                                <span className="tut-modal-cat">{selectedVideo.category}</span>
                                <h2>{selectedVideo.title}</h2>
                                <p>{selectedVideo.desc}</p>
                            </div>

                            <div className="tut-comments">
                                <div className="tut-comments-header">
                                    <h3>Comments ({sortedComments.length})</h3>
                                    <div className="tut-comments-sort">
                                        <button className={sortMode === 'newest' ? 'active' : ''} onClick={() => setSortMode('newest')}>Newest</button>
                                        <button className={sortMode === 'oldest' ? 'active' : ''} onClick={() => setSortMode('oldest')}>Oldest</button>
                                        <button className={sortMode === 'top' ? 'active' : ''} onClick={() => setSortMode('top')}>Top</button>
                                    </div>
                                </div>
                                <form className="tut-comment-form" onSubmit={submitComment}>
                                    <input
                                        type="text"
                                        placeholder="Your name"
                                        value={commentName}
                                        onChange={e => setCommentName(e.target.value)}
                                        required
                                    />
                                    <textarea
                                        placeholder="Add a comment..."
                                        value={commentText}
                                        onChange={e => setCommentText(e.target.value)}
                                        required
                                    />
                                    <button type="submit">Post Comment</button>
                                </form>
                                <div className="tut-comments-list">
                                    {sortedComments.map(c => (
                                        <div key={c.id} className="tut-comment">
                                            <div className="tut-comment-avatar">{(c.name || 'A').charAt(0).toUpperCase()}</div>
                                            <div className="tut-comment-body">
                                                <div className="tut-comment-meta">
                                                    <strong>{c.name}</strong>
                                                    {c.video_id && c.video_id !== selectedVideo.id && (
                                                        <span className="tut-comment-badge">{c.video_id}</span>
                                                    )}
                                                </div>
                                                <p>{c.text}</p>
                                            </div>
                                        </div>
                                    ))}
                                    {sortedComments.length === 0 && (
                                        <p className="tut-comments-empty">No comments yet. Be the first!</p>
                                    )}
                                </div>
                            </div>
                        </div>

                        <div className="tut-modal-sidebar">
                            <h3>Related Videos</h3>
                            {relatedVideos.map(v => (
                                <div
                                    key={v.id}
                                    className="tut-related"
                                    onClick={() => openVideo(v)}
                                >
                                    <div className="tut-related-thumb">
                                        <PlayIcon />
                                    </div>
                                    <div className="tut-related-body">
                                        <strong>{v.title}</strong>
                                        <span>{v.category}{v.duration ? ` · ${v.duration}` : ''}</span>
                                    </div>
                                </div>
                            ))}
                            {relatedVideos.length === 0 && (
                                <p className="tut-related-empty">No related videos.</p>
                            )}
                        </div>

                        <button className="tut-modal-close" onClick={closeModal}>
                            <CloseIcon />
                        </button>
                    </div>
                </div>
            )}
        </>
    );
}
