import { useTheme } from '../hooks/useTheme';

export default function BackgroundCanvas() {
    const { isLight } = useTheme();

    const darkPaths = (
        <>
            <path d="M -72 696 C 168 576, 384 640, 600 536 C 816 432, 888 352, 1056 448 C 1200 536, 1224 624, 1320 552 L 1320 816 L -72 816 Z" fill="rgba(16,185,129,0.06)" />
            <path d="M 744 -56 C 960 56, 1080 192, 1056 352 C 1032 520, 960 552, 1164 624 L 1320 568 L 1320 -56 Z" fill="rgba(16,185,129,0.07)" />
            <path d="M -48 0 C 72 72, 204 32, 312 144 C 408 240, 384 376, 264 408 C 48 480, -48 424, -48 352 Z" fill="rgba(16,185,129,0.05)" />
            <path d="M 84 728 C 276 624, 480 680, 636 568 C 816 440, 864 408, 1032 480" fill="none" stroke="rgba(16,185,129,0.12)" strokeWidth="1.4" />
            <path d="M -36 496 C 144 424, 312 480, 480 392 C 672 248, 792 280, 840 288" fill="none" stroke="rgba(16,185,129,0.08)" strokeWidth="1" />
            <circle cx="696" cy="160" r="78" fill="rgba(16,185,129,0.05)" />
            <circle cx="132" cy="608" r="50" fill="rgba(16,185,129,0.05)" />
            <circle cx="468" cy="728" r="34" fill="rgba(16,185,129,0.05)" />
        </>
    );

    const lightPaths = (
        <>
            <path d="M -72 696 C 168 576, 384 640, 600 536 C 816 432, 888 352, 1056 448 C 1200 536, 1224 624, 1320 552 L 1320 816 L -72 816 Z" fill="rgba(16,185,129,0.08)" />
            <path d="M 744 -56 C 960 56, 1080 192, 1056 352 C 1032 520, 960 552, 1164 624 L 1320 568 L 1320 -56 Z" fill="rgba(14,163,113,0.08)" />
            <path d="M -48 0 C 72 72, 204 32, 312 144 C 408 240, 384 376, 264 408 C 48 480, -48 424, -48 352 Z" fill="rgba(16,185,129,0.06)" />
            <path d="M 84 728 C 276 624, 480 680, 636 568 C 816 440, 864 408, 1032 480" fill="none" stroke="rgba(16,185,129,0.12)" strokeWidth="1.4" />
            <path d="M -36 496 C 144 424, 312 480, 480 392 C 672 248, 792 280, 840 288" fill="none" stroke="rgba(16,185,129,0.08)" strokeWidth="1" />
            <circle cx="696" cy="160" r="78" fill="rgba(16,185,129,0.05)" />
            <circle cx="132" cy="608" r="50" fill="rgba(16,185,129,0.05)" />
            <circle cx="468" cy="728" r="34" fill="rgba(16,185,129,0.05)" />
        </>
    );

    return (
        <div className="bg-canvas">
            <svg viewBox="0 0 1200 800" preserveAspectRatio="xMidYMid slice">
                {isLight ? lightPaths : darkPaths}
            </svg>
        </div>
    );
}
