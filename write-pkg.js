const fs = require('fs');
const pkg = {
  name: 'dispatch-react',
  private: true,
  version: '1.0.0',
  type: 'module',
  scripts: { dev: 'vite', build: 'vite build', preview: 'vite preview' },
  dependencies: { react: '^18.3.1', 'react-dom': '^18.3.1', 'react-router-dom': '^6.26.2' },
  devDependencies: { '@vitejs/plugin-react': '^4.3.1', vite: '^5.4.8' }
};
fs.writeFileSync('C:/xampp/htdocs/nexus_tms_doc/react-app/package.json', JSON.stringify(pkg, null, 2));
console.log('written');
