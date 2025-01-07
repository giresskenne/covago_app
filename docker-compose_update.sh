#!/bin/bash

# Define the latest version of Docker Compose (check https://github.com/docker/compose/releases)
LATEST_VERSION="2.25.0"

# Download the latest version
echo "Downloading Docker Compose version $LATEST_VERSION..."
sudo curl -L "https://github.com/docker/compose/releases/download/v${LATEST_VERSION}/docker-compose-$(uname -s)-$(uname -m)" -o /usr/local/bin/docker-compose

# Make Docker Compose executable
echo "Setting executable permissions..."
sudo chmod +x /usr/local/bin/docker-compose

# Verify the installation
echo "Verifying Docker Compose installation..."
docker-compose --version

# Print success message
if [ $? -eq 0 ]; then
  echo "Docker Compose has been successfully updated to version $LATEST_VERSION."
else
  echo "Failed to update Docker Compose. Please check for errors."
fi
