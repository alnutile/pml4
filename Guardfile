guard 'phpunit2', :tests_path => 'app/tests', :cli => '--colors' do
  watch(%r{^.+Test.php$})
  watch(%r{app/(.+)/(.+).php}) { |m| "tests/#{m[1]}/#{m[2]}Test.php" }
end
