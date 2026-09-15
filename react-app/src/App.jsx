import { BrowserRouter, Routes, Route } from 'react-router-dom';
import Home from './pages/Home';
import VideoDocs from './pages/VideoDocs';
import Tutorials from './pages/Tutorials';

export default function App() {
    return (
        <BrowserRouter>
            <Routes>
                <Route path="/" element={<Home />} />
                <Route path="/docs" element={<VideoDocs />} />
                <Route path="/tutorials" element={<Tutorials />} />
            </Routes>
        </BrowserRouter>
    );
}
