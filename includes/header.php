<!DOCTYPE html>
<html class="dark" lang="en">
<head>
    <meta charset="utf-8"/>
    <meta content="width=device-width, initial-scale=1.0" name="viewport"/>
    <title><?php echo isset($pageTitle) ? $pageTitle : 'Social Connector'; ?></title>
    <script src="https://cdn.tailwindcss.com?plugins=forms,container-queries"></script>
    <link href="https://fonts.googleapis.com/css2?family=Manrope:wght@400;600;700;800&family=Inter:wght@400;500;600&display=swap" rel="stylesheet"/>
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&display=swap" rel="stylesheet"/>
    <script id="tailwind-config">
        tailwind.config = {
            darkMode: "class",
            theme: {
                extend: {
                    "colors": {
                        "surface-container": "#181924",
                        "background": "#0d0d15",
                        "inverse-surface": "#fcf8ff",
                        "secondary-fixed": "#e3e0f7",
                        "error-dim": "#c8475d",
                        "secondary": "#c6c4da",
                        "outline-variant": "#474657",
                        "secondary-container": "#242435",
                        "on-tertiary": "#383588",
                        "on-secondary-fixed-variant": "#5a5a6c",
                        "on-tertiary-fixed-variant": "#373487",
                        "tertiary-fixed-dim": "#a4a2fc",
                        "surface": "#0d0d15",
                        "surface-container-low": "#12121c",
                        "primary": "#ac8aff",
                        "surface-tint": "#ac8aff",
                        "on-surface-variant": "#aba9bd",
                        "on-primary-fixed-variant": "#5313bd",
                        "on-tertiary-fixed": "#160e68",
                        "error-container": "#8a1632",
                        "on-secondary-container": "#a3a2b7",
                        "surface-variant": "#242434",
                        "on-error-container": "#ff97a3",
                        "primary-container": "#8f60fa",
                        "secondary-dim": "#b9b7cc",
                        "surface-container-highest": "#242434",
                        "tertiary-fixed": "#b3b1ff",
                        "inverse-on-surface": "#55545e",
                        "tertiary-container": "#b3b1ff",
                        "outline": "#757486",
                        "tertiary": "#c3c0ff",
                        "primary-fixed-dim": "#bfa5ff",
                        "on-primary-fixed": "#31007b",
                        "on-primary-container": "#000000",
                        "primary-fixed": "#cbb6ff",
                        "inverse-primary": "#6e3bd7",
                        "surface-container-lowest": "#000000",
                        "on-secondary": "#3f3f50",
                        "on-error": "#490013",
                        "surface-bright": "#2a2b3c",
                        "on-background": "#e6e3f8",
                        "on-secondary-fixed": "#3e3e4f",
                        "surface-container-high": "#1e1e2c",
                        "on-tertiary-container": "#2e2a7e",
                        "on-primary": "#280067",
                        "surface-dim": "#0d0d15",
                        "secondary-fixed-dim": "#d4d2e8",
                        "error": "#fd6f85",
                        "tertiary-dim": "#9695ee",
                        "on-surface": "#e6e3f8",
                        "primary-dim": "#8455ef"
                    },
                    "borderRadius": {
                        "DEFAULT": "0.5rem",
                        "lg": "0.5rem",
                        "xl": "0.75rem",
                        "full": "9999px"
                    },
                    "fontFamily": {
                        "headline": ["Manrope"],
                        "body": ["Inter"],
                        "label": ["Inter"]
                    }
                },
            },
        }
    </script>
    <style>
        body { font-family: 'Inter', sans-serif; background-color: #0d0d15; color: #e6e3f8; }
        .font-manrope { font-family: 'Manrope', sans-serif; }
        .material-symbols-outlined { font-variation-settings: 'FILL' 0, 'wght' 400, 'GRAD' 0, 'opsz' 24; }
        .no-scrollbar::-webkit-scrollbar { display: none; }
        .no-scrollbar { -ms-overflow-style: none; scrollbar-width: none; }
        
        /* Custom styles from other pages */
        .editorial-shadow { box-shadow: 0 8px 24px rgba(0, 0, 0, 0.4); }
        .ghost-border { border: 1px solid rgba(71, 70, 87, 0.2); }
        .signature-gradient { background: linear-gradient(135deg, #ac8aff 0%, #8455ef 100%); }
        .glass-panel { background: rgba(18, 18, 26, 0.4); backdrop-filter: blur(16px); border: 1px solid rgba(255, 255, 255, 0.05); }
        .primary-gradient { background: linear-gradient(135deg, #ac8aff 0%, #8455ef 100%); }
        .glass-card { background: rgba(36, 36, 52, 0.7); backdrop-filter: blur(20px); }
        .ambient-glow { box-shadow: 0 8px 32px 0 rgba(0, 0, 0, 0.4); }
    </style>
</head>
<body class="bg-surface <?php echo isset($bodyClass) ? $bodyClass : ''; ?>">
    
<?php include 'includes/showToast.php'; ?>
