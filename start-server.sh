#!/usr/bin/env bash
# ==============================================================================
# HIT Hoopers - Local Development Server Launcher
# Uses the installed PHP environment to serve the website instantly.
# ==============================================================================

PORT=8000
HOST="127.0.0.1"
DOCROOT="$(cd "$(dirname "${BASH_SOURCE[0]}")" && pwd)"

echo "--------------------------------------------------------"
echo "Starting HIT Hoopers Development Server..."
echo "Document Root: $DOCROOT"
echo "Server URL:    http://$HOST:$PORT"
echo "--------------------------------------------------------"
echo "Press Ctrl+C to stop the server."
echo ""

# Ensure user-installed php is on PATH
export PATH="$HOME/.local/bin:$PATH"

php -S "$HOST:$PORT" -t "$DOCROOT"
