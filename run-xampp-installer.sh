#!/usr/bin/env bash
# ==============================================================================
# Helper Script to Run the Official XAMPP Linux Installer
#
# Because XAMPP installs Apache, MySQL, and PHP system-wide into /opt/lampp,
# Linux requires root privileges (sudo).
# ==============================================================================

DIR="$(cd "$(dirname "${BASH_SOURCE[0]}")" && pwd)"
INSTALLER="$DIR/xampp-linux-x64-8.2.12-0-installer.run"

if [ ! -f "$INSTALLER" ]; then
  echo "Error: Installer not found at $INSTALLER"
  exit 1
fi

echo "Making installer executable..."
chmod +x "$INSTALLER"

echo "Launching XAMPP installer with sudo (enter your system password if prompted)..."
sudo "$INSTALLER"

echo ""
echo "Installation complete!"
echo "To start XAMPP services, run:"
echo "  sudo /opt/lampp/lampp start"
echo ""
echo "To link this project to XAMPP htdocs, run:"
echo "  sudo ln -s \"$DIR\" /opt/lampp/htdocs/hit-hoopers"
echo "Then open: http://localhost/hit-hoopers/"
